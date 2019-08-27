--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ppl; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.ppl (
    id integer NOT NULL,
    name character varying NOT NULL,
    num bigint NOT NULL,
    score smallint DEFAULT 0 NOT NULL,
    ip character varying NOT NULL
);


ALTER TABLE public.ppl OWNER TO root;

--
-- Name: ppl_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.ppl_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ppl_id_seq OWNER TO root;

--
-- Name: ppl_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.ppl_id_seq OWNED BY public.ppl.id;


--
-- Name: soal; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.soal (
    id integer NOT NULL,
    pertanyaan text NOT NULL,
    pilihan_1 text NOT NULL,
    pilihan_2 text NOT NULL,
    pilihan_3 text NOT NULL,
    pilihan_4 text NOT NULL,
    kunci_jawaban character(1) NOT NULL
);


ALTER TABLE public.soal OWNER TO root;

--
-- Name: soal_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.soal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.soal_id_seq OWNER TO root;

--
-- Name: soal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.soal_id_seq OWNED BY public.soal.id;


--
-- Name: ppl id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ppl ALTER COLUMN id SET DEFAULT nextval('public.ppl_id_seq'::regclass);


--
-- Name: soal id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.soal ALTER COLUMN id SET DEFAULT nextval('public.soal_id_seq'::regclass);


--
-- Name: ppl ppl_name_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ppl
    ADD CONSTRAINT ppl_name_key UNIQUE (name);


--
-- Name: ppl ppl_num_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ppl
    ADD CONSTRAINT ppl_num_key UNIQUE (num);


--
-- Name: ppl ppl_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ppl
    ADD CONSTRAINT ppl_pkey PRIMARY KEY (id);


--
-- Name: soal soal_pertanyaan_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.soal
    ADD CONSTRAINT soal_pertanyaan_key UNIQUE (pertanyaan);


--
-- Name: soal soal_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.soal
    ADD CONSTRAINT soal_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

