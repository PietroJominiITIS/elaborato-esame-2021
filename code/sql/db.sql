-- TABLE BOX

CREATE TABLE Box (
  BoxId int(11) NOT NULL AUTO_INCREMENT,
  CaseT int(11) NOT NULL,
  Location varchar(2) NOT NULL,
  ArchivingDate date NOT NULL,
  DeletionDate date DEFAULT NULL,
  DeletionReport TEXT DEFAULT NULL,

  PRIMARY KEY (BoxId),
  FOREIGN KEY (CaseT) REFERENCES CaseT (CaseId),
  FOREIGN KEY (Location) REFERENCES Court (Location),

  CHECK (DeletionDate IS NULL OR YEAR(DeletionDate) - YEAR(ArchivingDate) >= 50),
  CHECK (DeletionDate IS NULL OR DeletionReport IS NOT NULL)
);


--  TABLE CaseOutcome

CREATE TABLE CaseOutcome (
  Name varchar(20) NOT NULL,
  Description text NOT NULL,

  PRIMARY KEY (Name)
);

INSERT INTO CaseOutcome (Name, Description) VALUES
  ('Condemned', 'The accused has been condamned'),
  ('Acquitted', 'The accused has been aquitted');


-- TABLE CaseStatus

CREATE TABLE CaseStatus (
  Name varchar(20) NOT NULL,
  Description text NOT NULL,

  PRIMARY KEY (Name)
);

INSERT INTO CaseStatus (Name, Description) VALUES
  ('Preliminary', 'Preliminary stage'),
  ('First', 'Takes place before the court'),
  ('Second', 'Takes place before the court of appeal'),
  ('Third', 'Takes place in cassation'),
  ('Canceled', 'The case is no longer active');


-- TABLE CaseT

CREATE TABLE CaseT (
  CaseId int(11) NOT NULL AUTO_INCREMENT,
  Court varchar(2) NOT NULL,
  Status varchar(20) DEFAULT NULL,
  Outcome varchar(20) DEFAULT NULL,
  Crime text NOT NULL,
  Year int(4) NOT NULL,

  PRIMARY KEY (CaseId),
  FOREIGN KEY (Status) REFERENCES CaseStatus (Name) ON UPDATE CASCADE,
  FOREIGN KEY (Outcome) REFERENCES CaseOutcome (Name) ON UPDATE CASCADE,
  FOREIGN KEY (Court) REFERENCES Court (Location)
);


-- TABLE Court

CREATE TABLE Court (
  Location varchar(2) NOT NULL,
  Name text NOT NULL,

  -- len 32 so that it can hold an md5 hased password
  Password varchar(32) NOT NULL,

  PRIMARY KEY (Location)
);

INSERT INTO Court (Location, Name, Password) VALUES
  ('AL', 'Alessandria', 'e892e780304dc3ef15e69b9f3fed3669'),
  ('AT', 'Asti', 'fa868488740aa25870ced6b9169951fb'),
  ('BI', 'Biella', 'af7f0273997b9b290bd7c57aa19f36c2'),
  ('CN', 'Cuneo', '1c2903397d8833382673bab22aa8b937'),
  ('NO', 'Novara', 'c2f3f489a00553e7a01d369c103c7251'),
  ('TO', 'Torino', '304917b92bc3dc0953aab8356f74c02c'),
  ('VB', 'Verbania', '952e108649eee4b686c2431edc8fcd17'),
  ('VC', 'Vercelli', 'b7128ad1d9b838be26989d1037a8c987');


-- TABLE Document

CREATE TABLE Document (
  DocumentId int(11) NOT NULL AUTO_INCREMENT,
  Box int(11) NOT NULL,
  Type varchar(20) NOT NULL,
  Description text NOT NULL,
  AcquisitionDate date NOT NULL,

  PRIMARY KEY (DocumentId),
  FOREIGN KEY (Box) REFERENCES Box (BoxId),
  FOREIGN KEY (Type) REFERENCES DocumentType (Name) ON UPDATE CASCADE
);


-- TABLE DocumentType

CREATE TABLE DocumentType (
  Name varchar(20) NOT NULL,

  PRIMARY KEY (Name)
);

INSERT INTO DocumentType (Name) VALUES
  (Letter),
  (Photo),
  (Receipt);


-- TABLE Evidence

CREATE TABLE Evidence (
  EvidenceId int(11) NOT NULL AUTO_INCREMENT,
  Box int(11) NOT NULL,
  Description text NOT NULL,
  AcquisitionDate date NOT NULL,
  Label text NOT NULL,

  PRIMARY KEY (EvidenceId),
  FOREIGN KEY (Box) REFERENCES Box (BoxId)
);


-- TABLE Paper

CREATE TABLE Paper (
  PaperId int(11) NOT NULL AUTO_INCREMENT,
  Box int(11) NOT NULL,
  Place text NOT NULL,
  PersonCF varchar(16) NOT NULL,
  RegistrationDate date NOT NULL,

  PRIMARY KEY (PaperId)
  FOREIGN KEY (Box) REFERENCES Box (BoxId)
);


-- TABLE Report

CREATE TABLE Report (
  ReportId int(11) NOT NULL AUTO_INCREMENT,
  Box int(11) NOT NULL,
  Place text NOT NULL,
  Date date NOT NULL,

  PRIMARY KEY (ReportId)
  FOREIGN KEY (Box) REFERENCES Box (BoxId)
);


-- TABLE Transition

CREATE TABLE Transition (
  TransitionId int(11) NOT NULL AUTO_INCREMENT,
  Box int(11) NOT NULL,
  FromL varchar(2) NOT NULL,
  ToL varchar(2) NOT NULL,
  Status varchar(20) NOT NULL,
  DepartureTime date DEFAULT NULL,
  ArrivalTime date DEFAULT NULL,
  AgentCF varchar(16) DEFAULT NULL,

  PRIMARY KEY (TransitionId),
  FOREIGN KEY (Box) REFERENCES Box (BoxId),
  FOREIGN KEY (FromL) REFERENCES Court (Location),
  FOREIGN KEY (ToL) REFERENCES Court (Location),
  FOREIGN KEY (Status) REFERENCES TransitionStatus (Name) ON UPDATE CASCADE
);


-- TABLE TransitionStatus

CREATE TABLE TransitionStatus (
  Name varchar(20) NOT NULL,
  Description text NOT NULL,

  ADD PRIMARY KEY (Name)
);

INSERT INTO TransitionStatus (Name, Description) VALUES
  (Accepted, The destintion court requested the transition),
  (Completed, The origin court accepted the transition),
  (Requested, The transition is taking place),
  (Transiting, The transition is completed);
