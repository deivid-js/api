--
-- PostgreSQL database dump
--

-- Dumped from database version 11.1
-- Dumped by pg_dump version 11.1

-- Started on 2019-10-17 20:54:29

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 16435)
-- Name: cidade; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cidade (
    cid_codigo integer NOT NULL,
    nome character varying(100) NOT NULL,
    est_sigla character varying(2) NOT NULL
);


ALTER TABLE public.cidade OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16438)
-- Name: cidade_cid_codigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cidade_cid_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cidade_cid_codigo_seq OWNER TO postgres;

--
-- TOC entry 2838 (class 0 OID 0)
-- Dependencies: 197
-- Name: cidade_cid_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cidade_cid_codigo_seq OWNED BY public.cidade.cid_codigo;


--
-- TOC entry 198 (class 1259 OID 16440)
-- Name: conta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conta (
    cnt_numero integer NOT NULL,
    descricao character varying(100) NOT NULL,
    valor numeric(15,2) NOT NULL,
    tipo character varying(1) NOT NULL,
    situacao character varying(1) NOT NULL,
    pes_codigo integer NOT NULL
);


ALTER TABLE public.conta OWNER TO postgres;

--
-- TOC entry 2839 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN conta.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.conta.tipo IS 'R - receber, P - pagar';


--
-- TOC entry 2840 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN conta.situacao; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.conta.situacao IS 'P - paga, A - em aberto';


--
-- TOC entry 199 (class 1259 OID 16443)
-- Name: conta_cnt_numero_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conta_cnt_numero_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conta_cnt_numero_seq OWNER TO postgres;

--
-- TOC entry 2841 (class 0 OID 0)
-- Dependencies: 199
-- Name: conta_cnt_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.conta_cnt_numero_seq OWNED BY public.conta.cnt_numero;


--
-- TOC entry 200 (class 1259 OID 16445)
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estado (
    est_sigla character varying(2) NOT NULL,
    nome character varying(100) NOT NULL
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16448)
-- Name: pessoa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pessoa (
    pes_codigo integer NOT NULL,
    nome character varying(100) NOT NULL,
    idade integer,
    email character varying(200),
    cid_codigo integer
);


ALTER TABLE public.pessoa OWNER TO postgres;

--
-- TOC entry 2699 (class 2604 OID 16451)
-- Name: cidade cid_codigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cidade ALTER COLUMN cid_codigo SET DEFAULT nextval('public.cidade_cid_codigo_seq'::regclass);


--
-- TOC entry 2700 (class 2604 OID 16452)
-- Name: conta cnt_numero; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conta ALTER COLUMN cnt_numero SET DEFAULT nextval('public.conta_cnt_numero_seq'::regclass);


--
-- TOC entry 2702 (class 2606 OID 16454)
-- Name: cidade cidade_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cidade
    ADD CONSTRAINT cidade_pk PRIMARY KEY (cid_codigo);


--
-- TOC entry 2704 (class 2606 OID 16456)
-- Name: conta conta_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_pk PRIMARY KEY (cnt_numero);


--
-- TOC entry 2706 (class 2606 OID 16458)
-- Name: estado estado_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estado
    ADD CONSTRAINT estado_pk PRIMARY KEY (est_sigla);


--
-- TOC entry 2708 (class 2606 OID 16460)
-- Name: pessoa pessoa_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pessoa
    ADD CONSTRAINT pessoa_pk PRIMARY KEY (pes_codigo);


--
-- TOC entry 2711 (class 2606 OID 16461)
-- Name: pessoa cidade_pessoa_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pessoa
    ADD CONSTRAINT cidade_pessoa_fk FOREIGN KEY (cid_codigo) REFERENCES public.cidade(cid_codigo);


--
-- TOC entry 2709 (class 2606 OID 16466)
-- Name: cidade estado_cidade_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cidade
    ADD CONSTRAINT estado_cidade_fk FOREIGN KEY (est_sigla) REFERENCES public.estado(est_sigla);


--
-- TOC entry 2710 (class 2606 OID 16471)
-- Name: conta pessoa_conta_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conta
    ADD CONSTRAINT pessoa_conta_fk FOREIGN KEY (pes_codigo) REFERENCES public.pessoa(pes_codigo);


-- Completed on 2019-10-17 20:54:30

--
-- PostgreSQL database dump complete
--

