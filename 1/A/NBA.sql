CREATE TABLE "Player" (
    "Id" int   NOT NULL,
    "TeamId" int   NOT NULL,
    "Name" varchar(100)   NOT NULL,
    "Stats" jsonb   NOT NULL,
    "Status" bool   NOT NULL,
    CONSTRAINT "pk_Player" PRIMARY KEY (
        "Id"
     )
);

CREATE TABLE "Team" (
    "Id" int   NOT NULL,
    "Name" varchar(100)   NOT NULL,
    "Points" jsonb   NULL,
    "Status" bool   NOT NULL,
    CONSTRAINT "pk_Team" PRIMARY KEY (
        "Id"
     )
);

CREATE TABLE "Game" (
    "Id" int   NOT NULL,
    "HostId" int   NOT NULL,
    "GuestId" int   NOT NULL,
    "Date" datetime   NOT NULL,
    "Result" jsonb   NOT NULL,
    "Status" bool   NOT NULL,
    CONSTRAINT "pk_Game" PRIMARY KEY (
        "Id"
     )
);

ALTER TABLE "Player" ADD CONSTRAINT "fk_Player_TeamId" FOREIGN KEY("TeamId")
REFERENCES "Team" ("Id");

ALTER TABLE "Game" ADD CONSTRAINT "fk_Game_HostId" FOREIGN KEY("HostId")
REFERENCES "Team" ("Id");

ALTER TABLE "Game" ADD CONSTRAINT "fk_Game_GuestId" FOREIGN KEY("GuestId")
REFERENCES "Team" ("Id");

CREATE INDEX "idx_Player_Name"
ON "Player" ("Name");

CREATE INDEX "idx_Team_Name"
ON "Team" ("Name");

CREATE INDEX "idx_Game_Date"
ON "Game" ("Date");

