from math import floor, sin
from pathlib import Path
from sys import argv


# All values are 32-bit integers and wrap to Z, but since in python
# integers aren't of fixed dimension we have to do it manually.
Z = 2 ** 32 - 1

# calculating Ks constants
K = [floor(2 ** 32 * abs(sin(i))) for i in range(1, 65)]

# per-round shift table
table = Path(__file__).parent / "s.txt"
s = [int(line) for line in table.read_text().splitlines()]

# Functions F and g for each round
functions = [
    (lambda B, C, D: (B & C) | (~B & D), lambda i: i),
    (lambda B, C, D: (D & B) | (~D & C), lambda i: (5 * i + 1) % 16),
    (lambda B, C, D: B ^ C ^ D, lambda i: (3 * i + 5) % 16),
    (lambda B, C, D: C ^ (B | ~D), lambda i: (7 * i) % 16),
]

# leftrotate function
leftrotate = lambda F, i: ((F << i) | (F >> (32 - i))) & Z


def md5(message: str) -> int:
    """Compute the md5 digest of a given message"""

    # encode the message and transform it into
    # a numeric bytearray
    message = message.encode("ascii")
    message = bytearray(message)

    # calculate padding
    L = (len(message) * 8) & (2 ** 64 - 1)
    N = max((L - 1), 0) // 512 + 1
    P = (512 * N) - 64 - L
    P //= 8

    # apply padding
    message += bytearray([0x80] * min(P, 1) + [0x0] * (P - 1))
    message += L.to_bytes(8, byteorder="little")

    # initial H values
    H = [0x67452301, 0xEFCDAB89, 0x98BADCFE, 0x10325476]

    # split into 512-bits long chunks
    chunks = [message[i : i + 64] for i in range(0, len(message), 64)]
    for chunk in chunks:

        # split chunk in 32-bits long words
        M = [chunk[i : i + 4] for i in range(0, len(chunk), 4)]
        M = [int.from_bytes(word, byteorder="little") for word in M]

        # init hash pieces
        A, B, C, D = H

        # iterations
        for i in range(64):

            # fetch current F and g functions
            current_round = i // 16
            F, g = functions[current_round]

            # apply hash transformation
            R = A + F(B, C, D) + K[i] + M[g(i)]
            Bn = B + leftrotate(R & Z, s[i])
            A, B, C, D = D, Bn & Z, B, C

        # update hash pieces
        Hn = [A, B, C, D]
        H = [(h + hn) & Z for h, hn in zip(H, Hn)]

    # compute digest by concatenating the hash pieces
    digest = sum(h << (32 * i) for i, h in enumerate(H))
    return digest


def hex_digest(digest: int) -> str:
    """Represent a md5 digest in hex format"""

    # the digest needs to be transformed from little to
    # big endian, so that it can be represented correctly
    # as an hex number
    digest = digest.to_bytes(16, byteorder="little")
    digest = int.from_bytes(digest, byteorder="big")

    return "{:032x}".format(digest)


# cli usage
if __name__ == "__main__":

    # check if input is present
    message = "" if len(argv) < 2 else argv[1]

    # print the digest
    digest = hex_digest(md5(message))
    print(digest)
