/*citizen table*/
CREATE TABLE citoyen (
    identity VARCHAR2(8) CONSTRAINT pk_citoyen PRIMARY KEY,
    fname VARCHAR2(30) NOT NULL,
    name VARCHAR2(30) NOT NULL, 
    email VARCHAR2(60) NOT NULL, 
    pwd VARCHAR2(20) NOT NULL, 
    gender CHAR(1) NOT NULL CONSTRAINT checkgender CHECK (gender IN ('M','F')), 
    age NUMBER(2,0) NOT NULL
);


/*employee table*/
CREATE TABLE employe (
    id VARCHAR2(8) CONSTRAINT pk_employe PRIMARY KEY , 
    nom VARCHAR2(35) NOT NULL , 
    prenom VARCHAR2(35) NOT NULL , 
    email VARCHAR2(100) NOT NULL , 
    sexe CHAR(1) NOT NULL CONSTRAINT checksexe CHECK (sexe IN ('M','F')), 
    code NUMBER(6,0) NOT NULL 
);


/*penalty table*/
CREATE TABLE penalite (
    code VARCHAR2(4) CONSTRAINT pk_penal PRIMARY KEY, 
    citizen_id VARCHAR2(8) NOT NULL , 
    reason VARCHAR2(100) NOT NULL, 
    prix NUMBER(4,0) DEFAULT 0 NOT NULL,
    CONSTRAINT fk_penal FOREIGN KEY (citizen_id)
        REFERENCES citoyen (identity)
);

/*SEQUENCE to increment the primary key of table "paye" */
CREATE SEQUENCE seq_paye START WITH 1 INCREMENT BY 1;

/*if a citizen pays his penalty, he will be deleted from the penalty table and registered here*/
CREATE TABLE paye (
    id NUMBER(8,0) DEFAULT seq_paye.NEXTVAL CONSTRAINT pk_paye PRIMARY KEY, 
    id_citizen VARCHAR2(8) NOT NULL, 
    code_penal VARCHAR2(4) NOT NULL , 
    CONSTRAINT fk_paye FOREIGN KEY (id_citizen)
        REFERENCES citoyen (identity)
);

