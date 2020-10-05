DROP if exists userSti
CREATE TABLE userSti (
    Id integer PRIMARY KEY AUTOINCREMENT,
    username varchar (50) UNIQUE NOT NULL,
    password varchar (255) NOT NULL,
    isAdmin INT(1) NOT NULL,
    isActive INT(1) NOT NULL
);
CREATE TABLE message(
    Id integer PRIMARY KEY  AUTOINCREMENT,
    receiptDate DATE NOT NULL,
    sender integer NULL,
    receiver integer NULL,
    sujet varchar (50) NOT NULL,
    messageBody varchar (500) NOT NULL,
    CONSTRAINT fk_sender FOREIGN KEY(sender) REFERENCES userSti(id),
    CONSTRAINT fk_receiver FOREIGN KEY(receiver) REFERENCES userSti(id)
);
