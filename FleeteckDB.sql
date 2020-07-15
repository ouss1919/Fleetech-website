--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: Carburant; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public."Carburant" AS ENUM (
    'essence',
    'gasoil',
    'diesel'
);


ALTER TYPE public."Carburant" OWNER TO postgres;

--
-- Name: ac_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ac_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ac_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: Activite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Activite" (
    id_main integer DEFAULT nextval('public.ac_id_seq'::regclass) NOT NULL,
    id_vehicule integer,
    id_ind character(50),
    historique character(50),
    type_op character(50),
    niveau character(50),
    nom_intervenant character(50),
    date date NOT NULL,
    temps character(50),
    type_maintenance character(50),
    causes text,
    etat character(50),
    cout integer
);


ALTER TABLE public."Activite" OWNER TO postgres;

--
-- Name: Activite_pr; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Activite_pr" (
    id_activite integer,
    id_pr integer
);


ALTER TABLE public."Activite_pr" OWNER TO postgres;

--
-- Name: Alerte; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Alerte" (
    id_veh integer,
    type character(50),
    id_alerte integer NOT NULL
);


ALTER TABLE public."Alerte" OWNER TO postgres;

--
-- Name: Carnet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Carnet" (
    date date NOT NULL,
    id_veh integer,
    kilometrage integer,
    litres integer,
    cout_car bigint
);


ALTER TABLE public."Carnet" OWNER TO postgres;

--
-- Name: Centre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Centre" (
    id_ce character(50) NOT NULL,
    nbr_reg bigint,
    nom character(50),
    chef character(50)
);


ALTER TABLE public."Centre" OWNER TO postgres;

--
-- Name: Indicateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Indicateur" (
    id_indic character(50) NOT NULL,
    temps_creation bigint,
    vitesse bigint,
    rmp_mot character(50),
    temperature integer,
    etat_sys_carb character(50),
    status_air_second character(50),
    entree_niv_carb bigint,
    taux_carb_mot bigint
);


ALTER TABLE public."Indicateur" OWNER TO postgres;

--
-- Name: Mission; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Mission" (
    id_miss character(50) NOT NULL,
    temps_dep bigint,
    temps_arrive bigint,
    indicateur character(50),
    nbr_vhcl integer,
    "kilometrage_départ" integer,
    kilometrage_arrive integer
);


ALTER TABLE public."Mission" OWNER TO postgres;

--
-- Name: Mission_chauffeur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Mission_chauffeur" (
    id_mission character(50),
    id_chauffeur integer,
    id_indicateur character(50),
    date_dep character(50),
    date_arrive character(50),
    kilometrage_dep integer,
    kilometrage_arrive integer,
    distance integer,
    max_vitesse integer,
    moy_vitesse integer
);


ALTER TABLE public."Mission_chauffeur" OWNER TO postgres;

--
-- Name: Mission_vehicule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Mission_vehicule" (
    id_miss character(50),
    id_veh integer,
    id_ind character(50),
    "kilométrage_dep" integer,
    "kilométrage_arriv" integer,
    vitesse_moy integer,
    max_vitesse integer
);


ALTER TABLE public."Mission_vehicule" OWNER TO postgres;

--
-- Name: pr_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pr_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pr_id_seq OWNER TO postgres;

--
-- Name: PR; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."PR" (
    id_piece integer DEFAULT nextval('public.pr_id_seq'::regclass) NOT NULL,
    piece character(50),
    fournisseur character(50),
    qnt_utilise integer DEFAULT 0,
    qnt_mqnt integer DEFAULT 0,
    prix_unt integer DEFAULT 0,
    constructeur character(50),
    id_unt integer
);


ALTER TABLE public."PR" OWNER TO postgres;

--
-- Name: Rapport; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Rapport" (
    id_rapport character(50) NOT NULL,
    titre character(50)
);


ALTER TABLE public."Rapport" OWNER TO postgres;

--
-- Name: Region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Region" (
    id_reg character(50) NOT NULL,
    nb_unt character(50),
    chef_reg character(50),
    nom_reg character(50)
);


ALTER TABLE public."Region" OWNER TO postgres;

--
-- Name: Unite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Unite" (
    nbr_vehicule bigint,
    surface bigint,
    voitures_entrants_jour bigint,
    voitures_sortants_jour bigint,
    voitures_op bigint,
    voitures_non_op bigint,
    id_unt integer NOT NULL,
    chef_unt character(50)
);


ALTER TABLE public."Unite" OWNER TO postgres;

--
-- Name: Unite_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Unite_log" (
    date date NOT NULL,
    id_unite integer NOT NULL,
    voitures_entrants integer,
    voitures_sortanrts integer,
    carb_consome integer
);


ALTER TABLE public."Unite_log" OWNER TO postgres;

--
-- Name: User; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."User" (
    username character(50),
    password character(50) NOT NULL,
    type character(50),
    "Nom" character(50),
    "Prenom" character(50),
    id_unite integer
);


ALTER TABLE public."User" OWNER TO postgres;

--
-- Name: vh_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vh_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vh_id_seq OWNER TO postgres;

--
-- Name: Vehicule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Vehicule" (
    kilometrage bigint,
    "année" bigint,
    id_v integer DEFAULT nextval('public.vh_id_seq'::regclass) NOT NULL,
    marque character(50),
    modele character(50),
    num_chassis bigint,
    etat character(50),
    vitesse_moy integer,
    id_unite integer,
    carburant character(10)
);


ALTER TABLE public."Vehicule" OWNER TO postgres;

--
-- Name: Video; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Video" (
    id_video character(50) NOT NULL,
    id_activite character(50),
    lien character(50),
    titre character(50)
);


ALTER TABLE public."Video" OWNER TO postgres;

--
-- Name: ch_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ch_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ch_id_seq OWNER TO postgres;

--
-- Name: chauffeur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chauffeur (
    id_ch integer DEFAULT nextval('public.ch_id_seq'::regclass) NOT NULL,
    nom character(50),
    prenom character(50),
    email character(50),
    tel bigint,
    role character(50),
    region character(50),
    date_embauche date,
    id_unite integer
);


ALTER TABLE public.chauffeur OWNER TO postgres;

--
-- Data for Name: Activite; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Activite" VALUES (26, 57, '1                                                 ', '                                                  ', 'controle                                          ', '2                                                 ', 'smail02                                           ', '2020-06-18', '2 mois                                            ', 'systematique                                      ', 'cause1', 'succes                                            ', 3000);
INSERT INTO public."Activite" VALUES (27, 59, '1                                                 ', '                                                  ', 'depannage                                         ', '2                                                 ', 'omar3                                             ', '2020-06-10', '3 mois                                            ', 'corrective                                        ', 'cause3', 'succes                                            ', 10000);
INSERT INTO public."Activite" VALUES (33, 23, '1                                                 ', '                                                  ', 'controle                                          ', '2                                                 ', 'rachide03                                         ', '2020-07-04', '2 jours                                           ', 'corrective                                        ', '', 'succes                                            ', 6000);
INSERT INTO public."Activite" VALUES (29, 59, '1                                                 ', '                                                  ', 'reparation                                        ', '3                                                 ', 'omar3                                             ', '2020-05-18', '2 mois                                            ', 'corrective                                        ', 'cause3', 'succes                                            ', 8000);
INSERT INTO public."Activite" VALUES (22, 61, '1                                                 ', '                                                  ', 'controle                                          ', '3                                                 ', 'omar3                                             ', '2020-07-02', '1 mois                                            ', 'systematique                                      ', 'cause2', 'succes                                            ', 6000);
INSERT INTO public."Activite" VALUES (34, 24, '1                                                 ', '                                                  ', 'corrective                                        ', '3                                                 ', 'abbesse04                                         ', '2020-06-18', '1 mois                                            ', 'systematique                                      ', '', 'echec                                             ', 4000);
INSERT INTO public."Activite" VALUES (28, 57, '1                                                 ', '                                                  ', 'inspection                                        ', '4                                                 ', 'smail02                                           ', '2020-06-20', '15 jours                                          ', 'systematique                                      ', 'cause1', 'echec                                             ', 8000);
INSERT INTO public."Activite" VALUES (25, 63, '1                                                 ', '                                                  ', 'controle                                          ', '3                                                 ', 'omar3                                             ', '2020-06-03', '4 mois                                            ', 'conditionnel                                      ', 'cause2', 'succes                                            ', 20000);
INSERT INTO public."Activite" VALUES (30, 60, '1                                                 ', '                                                  ', 'reparation                                        ', '2                                                 ', 'omar3                                             ', '2020-03-18', '2 jours                                           ', 'corrective                                        ', 'cause1', 'echec                                             ', 4000);
INSERT INTO public."Activite" VALUES (31, 59, '1                                                 ', '                                                  ', 'depanage                                          ', '3                                                 ', 'omar3                                             ', '2020-02-04', '10 jours                                          ', 'conditionnel                                      ', 'cause1', 'succes                                            ', 2000);
INSERT INTO public."Activite" VALUES (32, 62, '1                                                 ', '                                                  ', 'controle                                          ', '5                                                 ', 'omar3                                             ', '2020-06-28', '5 jours                                           ', 'conditionnel                                      ', 'cause1', 'succes                                            ', 10000);
INSERT INTO public."Activite" VALUES (35, 25, '1                                                 ', '                                                  ', 'depannage                                         ', '2                                                 ', 'abbesse04                                         ', '2020-06-28', '1 mois                                            ', 'conditionnel                                      ', '', 'succes                                            ', 7000);
INSERT INTO public."Activite" VALUES (21, 60, '1                                                 ', '                                                  ', 'reparation                                        ', '2                                                 ', 'smail02                                           ', '2020-07-01', '2 mois                                            ', 'systematique                                      ', 'cause1', 'echec                                             ', 4000);
INSERT INTO public."Activite" VALUES (20, 57, '1                                                 ', '                                                  ', 'inspection  controle                              ', '1                                                 ', 'omar3                                             ', '2020-07-04', '3 mois                                            ', 'corrective                                        ', 'cause2', 'succes                                            ', 10757);
INSERT INTO public."Activite" VALUES (24, 62, '1                                                 ', '                                                  ', 'depannage                                         ', '4                                                 ', 'smail02                                           ', '2020-07-07', '6 mois                                            ', 'corrective                                        ', 'cause1', 'echec                                             ', 6575);
INSERT INTO public."Activite" VALUES (23, 62, '1                                                 ', '                                                  ', 'reparation                                        ', '4                                                 ', 'omar3                                             ', '2020-07-03', '2 mois                                            ', 'conditionnel                                      ', 'cause1', 'succes                                            ', 6575);
INSERT INTO public."Activite" VALUES (36, 23, '1                                                 ', '                                                  ', 'controle                                          ', '2                                                 ', 'rachide02                                         ', '2020-07-07', '1 jour                                            ', 'corrective                                        ', '', 'succes                                            ', 6000);


--
-- Data for Name: Activite_pr; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Alerte; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Alerte" VALUES (61, 'consommation                                      ', 1);
INSERT INTO public."Alerte" VALUES (59, 'roulage                                           ', 2);
INSERT INTO public."Alerte" VALUES (56, 'kilometrage                                       ', 3);
INSERT INTO public."Alerte" VALUES (64, 'controle technique                                ', 4);
INSERT INTO public."Alerte" VALUES (60, 'maintenance                                       ', 5);
INSERT INTO public."Alerte" VALUES (61, 'roulage                                           ', 6);
INSERT INTO public."Alerte" VALUES (23, 'roulage                                           ', 10);
INSERT INTO public."Alerte" VALUES (23, 'controle technique                                ', 11);
INSERT INTO public."Alerte" VALUES (23, 'maintenance                                       ', 12);
INSERT INTO public."Alerte" VALUES (23, 'consommation                                      ', 13);
INSERT INTO public."Alerte" VALUES (23, 'kilometrage                                       ', 15);
INSERT INTO public."Alerte" VALUES (24, 'kilometrage                                       ', 14);


--
-- Data for Name: Carnet; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Centre; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Indicateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Indicateur" VALUES ('1                                                 ', 20, 240, '4000 tr/min                                       ', 40, 'bon                                               ', 'bon                                               ', 20, 60);


--
-- Data for Name: Mission; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Mission_chauffeur; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Mission_vehicule; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: PR; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."PR" VALUES (29, 'Disque de frein                                   ', 'f1                                                ', 3, 0, 3000, 'c1                                                ', 1);
INSERT INTO public."PR" VALUES (16, 'Plaquette de frein                                ', 'f2                                                ', 2, 3, 4000, 'c2                                                ', 1);
INSERT INTO public."PR" VALUES (34, 'Amortisseur                                       ', 'f1                                                ', 23, 24, 42000, 'c1                                                ', 1);
INSERT INTO public."PR" VALUES (39, 'piece de suspension                               ', 'f3                                                ', 5, 3, 274862, 'c3                                                ', 1);
INSERT INTO public."PR" VALUES (40, 'Roulement                                         ', 'f2                                                ', 7, 6, 10000, 'c2                                                ', 1);
INSERT INTO public."PR" VALUES (41, 'courroie                                          ', 'f2                                                ', 23, 24, 34000, 'f2                                                ', 1);
INSERT INTO public."PR" VALUES (42, 'Disque de frein                                   ', 'f1                                                ', 43, 54, 5000, 'c1                                                ', 2);
INSERT INTO public."PR" VALUES (43, 'Pièce moteur                                      ', 'f2                                                ', 45, 12, 7000, 'c2                                                ', 2);


--
-- Data for Name: Rapport; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Rapport" VALUES ('1                                                 ', 'Rapport1.pdf                                      ');
INSERT INTO public."Rapport" VALUES ('2                                                 ', 'Rapport2.pdf                                      ');
INSERT INTO public."Rapport" VALUES ('3                                                 ', 'Rapport3.pdf                                      ');


--
-- Data for Name: Region; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Unite; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Unite" VALUES (30, 300, 15, 15, 20, 10, 1, 'oussama                                           ');
INSERT INTO public."Unite" VALUES (55, 600, 30, 28, 40, 5, 2, 'said                                              ');


--
-- Data for Name: Unite_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Unite_log" VALUES ('2020-07-04', 1, 15, 15, 10000);
INSERT INTO public."Unite_log" VALUES ('2020-07-03', 1, 32, 42, 20000);
INSERT INTO public."Unite_log" VALUES ('2020-07-01', 1, 23, 13, 43000);
INSERT INTO public."Unite_log" VALUES ('2020-06-29', 1, 12, 31, 203123);
INSERT INTO public."Unite_log" VALUES ('2020-06-28', 1, 21, 31, 53453);
INSERT INTO public."Unite_log" VALUES ('2020-07-06', 2, 15, 31, 43000);
INSERT INTO public."Unite_log" VALUES ('2020-07-03', 2, 30, 15, 20000);


--
-- Data for Name: User; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."User" VALUES ('oussama19                                         ', 'admin                                             ', 'operationnel                                      ', 'Berarma                                           ', 'Oussama                                           ', 1);
INSERT INTO public."User" VALUES ('imene35                                           ', '1234                                              ', 'operationnel                                      ', 'Firas                                             ', 'imene                                             ', 2);


--
-- Data for Name: Vehicule; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Vehicule" VALUES (43455, NULL, 24, 'Peugeot                                           ', '307                                               ', 654543562, 'en maintenance                                    ', 80, 2, 'essence   ');
INSERT INTO public."Vehicule" VALUES (2435, NULL, 23, 'Toyota                                            ', 'AYGO                                              ', 3262, 'en panne                                          ', 100, 2, 'diesel    ');
INSERT INTO public."Vehicule" VALUES (13323, NULL, 25, 'Peugeot                                           ', '308                                               ', 3263665, 'bon etat                                          ', 90, 2, 'gasoil    ');
INSERT INTO public."Vehicule" VALUES (4324, NULL, 57, 'Peugeot                                           ', '504                                               ', 462311316, 'en maintenance                                    ', 60, 1, 'diesel    ');
INSERT INTO public."Vehicule" VALUES (23213, 2015, 56, 'Peugeot                                           ', '308                                               ', 6345311519, 'bon etat                                          ', 82, 1, 'diesel    ');
INSERT INTO public."Vehicule" VALUES (3627, NULL, 59, 'Peugeot                                           ', '208                                               ', 33111617, 'en maintenance                                    ', 113, 1, 'diesel    ');
INSERT INTO public."Vehicule" VALUES (32422, NULL, 60, 'Peugeot                                           ', '208                                               ', 312311819, 'bon etat                                          ', 90, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (32442, NULL, 61, 'Renault                                           ', 'CLIO 4                                            ', 316237168, 'bon etat                                          ', 70, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (3424, NULL, 62, 'Renault                                           ', 'CAPTUR                                            ', 4332424, 'en panne                                          ', 75, 1, 'gasoil    ');
INSERT INTO public."Vehicule" VALUES (2342, NULL, 63, 'Dacia                                             ', 'SANDERO                                           ', 3453453, 'en panne                                          ', 65, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (534534, NULL, 64, 'Dacia                                             ', 'DUSTER                                            ', 34535345, 'bon etat                                          ', 65, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (34534, NULL, 65, 'OPEL                                              ', 'CORSA                                             ', 7475745, 'bon etat                                          ', 87, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (24352, NULL, 66, 'FIA                                               ', '500                                               ', 56765756, 'en panne                                          ', 90, 1, 'essence   ');
INSERT INTO public."Vehicule" VALUES (43345, NULL, 67, 'Citroen                                           ', 'C4                                                ', 4356, 'bon etat                                          ', 90, 1, 'diesel    ');


--
-- Data for Name: Video; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: chauffeur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.chauffeur VALUES (8, 'IMAD                                              ', 'BERARMA                                           ', 'imad@esi.dz                                       ', 674715715, 'R2                                                ', 'Setif                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (9, 'HAMZA                                             ', 'ABESS                                             ', 'hamza@esi.dz                                      ', 234232342, 'R4                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (10, 'MAJID                                             ', 'SAHLI                                             ', 'majid@esi.dz                                      ', 3467243, 'R1                                                ', 'Blida                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (11, 'FARES                                             ', 'MOKHTAR                                           ', 'fares@esi.dz                                      ', 72354237, 'R3                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (12, 'MOKHTAR                                           ', 'BOUZID                                            ', 'bouzid@esi.dz                                     ', 23645222, 'R1                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (13, 'ZOUBIR                                            ', 'FARES                                             ', 'zoubir@esi.dz                                     ', 2632132, 'R1                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (14, 'KAMEL                                             ', 'GHERBI                                            ', 'kamel@esi.dz                                      ', 3282822, 'R2                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (3, 'MADANI                                            ', 'ZENATI                                            ', 'madani@esi.dz                                     ', 243423, 'R3                                                ', 'Setif                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (5, 'BOUMAZA                                           ', 'RAOUF                                             ', 'raouf@esi.dz                                      ', 3273443, 'R2                                                ', 'Batna                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (7, 'FAYCEL                                            ', 'BOUMAZA                                           ', 'faycel@esi.dz                                     ', 674715715, 'R5                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (4, 'SALHI                                             ', 'ANIS                                              ', 'fa_salhi@esi.dz                                   ', 621715715, 'R2                                                ', 'Alger                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (2, 'OUSSAMA                                           ', 'BERARMA                                           ', 'fo_berarma@esi.dz                                 ', 674718715, 'R1                                                ', 'Setif                                             ', NULL, 1);
INSERT INTO public.chauffeur VALUES (6, 'Mokhtar                                           ', 'omar                                              ', 'mokhtar@esi.dz                                    ', 235642722, 'Role1                                             ', 'Alger                                             ', NULL, 2);
INSERT INTO public.chauffeur VALUES (15, 'Fares                                             ', 'kamel                                             ', 'fares@esi.dz                                      ', 45375743, 'Role2                                             ', 'Alger                                             ', NULL, 2);


--
-- Name: ac_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ac_id_seq', 36, true);


--
-- Name: ch_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ch_id_seq', 15, true);


--
-- Name: pr_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pr_id_seq', 43, true);


--
-- Name: vh_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vh_id_seq', 67, true);


--
-- Name: Activite Activite_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Activite"
    ADD CONSTRAINT "Activite_pkey" PRIMARY KEY (id_main);


--
-- Name: Alerte Alerte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Alerte"
    ADD CONSTRAINT "Alerte_pkey" PRIMARY KEY (id_alerte);


--
-- Name: Carnet Carnet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Carnet"
    ADD CONSTRAINT "Carnet_pkey" PRIMARY KEY (date);


--
-- Name: Centre Centre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Centre"
    ADD CONSTRAINT "Centre_pkey" PRIMARY KEY (id_ce);


--
-- Name: Indicateur Indicateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Indicateur"
    ADD CONSTRAINT "Indicateur_pkey" PRIMARY KEY (id_indic);


--
-- Name: Mission Mission_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission"
    ADD CONSTRAINT "Mission_pkey" PRIMARY KEY (id_miss);


--
-- Name: PR PR_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."PR"
    ADD CONSTRAINT "PR_pkey" PRIMARY KEY (id_piece);


--
-- Name: Rapport Rapports_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Rapport"
    ADD CONSTRAINT "Rapports_pkey" PRIMARY KEY (id_rapport);


--
-- Name: Region Region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Region"
    ADD CONSTRAINT "Region_pkey" PRIMARY KEY (id_reg);


--
-- Name: Unite_log Unite_log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Unite_log"
    ADD CONSTRAINT "Unite_log_pkey" PRIMARY KEY (id_unite, date);


--
-- Name: Unite Unite_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Unite"
    ADD CONSTRAINT "Unite_pkey" PRIMARY KEY (id_unt);


--
-- Name: User User_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."User"
    ADD CONSTRAINT "User_pkey" PRIMARY KEY (password);


--
-- Name: Vehicule Vehicule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vehicule"
    ADD CONSTRAINT "Vehicule_pkey" PRIMARY KEY (id_v);


--
-- Name: Video Video_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Video"
    ADD CONSTRAINT "Video_pkey" PRIMARY KEY (id_video);


--
-- Name: chauffeur chauffeur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chauffeur
    ADD CONSTRAINT chauffeur_pkey PRIMARY KEY (id_ch);


--
-- Name: Activite Activite_id_ind_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Activite"
    ADD CONSTRAINT "Activite_id_ind_fkey" FOREIGN KEY (id_ind) REFERENCES public."Indicateur"(id_indic) NOT VALID;


--
-- Name: Activite Activite_id_vehicule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Activite"
    ADD CONSTRAINT "Activite_id_vehicule_fkey" FOREIGN KEY (id_vehicule) REFERENCES public."Vehicule"(id_v) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Activite_pr Activite_pr_id_activite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Activite_pr"
    ADD CONSTRAINT "Activite_pr_id_activite_fkey" FOREIGN KEY (id_activite) REFERENCES public."Activite"(id_main) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Activite_pr Activite_pr_id_pr_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Activite_pr"
    ADD CONSTRAINT "Activite_pr_id_pr_fkey" FOREIGN KEY (id_pr) REFERENCES public."PR"(id_piece) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Alerte Alerte_id_veh_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Alerte"
    ADD CONSTRAINT "Alerte_id_veh_fkey" FOREIGN KEY (id_veh) REFERENCES public."Vehicule"(id_v) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Carnet Carnet_id_veh_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Carnet"
    ADD CONSTRAINT "Carnet_id_veh_fkey" FOREIGN KEY (id_veh) REFERENCES public."Vehicule"(id_v) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Mission_chauffeur Mission_chauffeur_id_chauffeur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_chauffeur"
    ADD CONSTRAINT "Mission_chauffeur_id_chauffeur_fkey" FOREIGN KEY (id_chauffeur) REFERENCES public.chauffeur(id_ch) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Mission_chauffeur Mission_chauffeur_id_indicateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_chauffeur"
    ADD CONSTRAINT "Mission_chauffeur_id_indicateur_fkey" FOREIGN KEY (id_indicateur) REFERENCES public."Indicateur"(id_indic) NOT VALID;


--
-- Name: Mission_chauffeur Mission_chauffeur_id_mission_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_chauffeur"
    ADD CONSTRAINT "Mission_chauffeur_id_mission_fkey" FOREIGN KEY (id_mission) REFERENCES public."Mission"(id_miss) NOT VALID;


--
-- Name: Mission Mission_indicateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission"
    ADD CONSTRAINT "Mission_indicateur_fkey" FOREIGN KEY (indicateur) REFERENCES public."Indicateur"(id_indic) NOT VALID;


--
-- Name: Mission_vehicule Mission_vehicule_id_ind_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_vehicule"
    ADD CONSTRAINT "Mission_vehicule_id_ind_fkey" FOREIGN KEY (id_ind) REFERENCES public."Indicateur"(id_indic) NOT VALID;


--
-- Name: Mission_vehicule Mission_vehicule_id_miss_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_vehicule"
    ADD CONSTRAINT "Mission_vehicule_id_miss_fkey" FOREIGN KEY (id_miss) REFERENCES public."Mission"(id_miss) NOT VALID;


--
-- Name: Mission_vehicule Mission_vehicule_id_veh_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Mission_vehicule"
    ADD CONSTRAINT "Mission_vehicule_id_veh_fkey" FOREIGN KEY (id_veh) REFERENCES public."Vehicule"(id_v) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: PR PR_id_unt_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."PR"
    ADD CONSTRAINT "PR_id_unt_fkey" FOREIGN KEY (id_unt) REFERENCES public."Unite"(id_unt) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: Unite_log Unite_log_id_unite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Unite_log"
    ADD CONSTRAINT "Unite_log_id_unite_fkey" FOREIGN KEY (id_unite) REFERENCES public."Unite"(id_unt) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: User User_id_unite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."User"
    ADD CONSTRAINT "User_id_unite_fkey" FOREIGN KEY (id_unite) REFERENCES public."Unite"(id_unt) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: Vehicule Vehicule_id_unite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vehicule"
    ADD CONSTRAINT "Vehicule_id_unite_fkey" FOREIGN KEY (id_unite) REFERENCES public."Unite"(id_unt) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: chauffeur chauffeur_id_unite_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chauffeur
    ADD CONSTRAINT chauffeur_id_unite_fkey FOREIGN KEY (id_unite) REFERENCES public."Unite"(id_unt) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

