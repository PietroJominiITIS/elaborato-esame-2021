#!/bin/sh
# clean latex compile files

# iterate over desired exts
for ext in aux fdb_latexmk fls log synctex.gz out toc; do

    # find and delete all file with current ext
    find . -name *.$ext -delete

done
