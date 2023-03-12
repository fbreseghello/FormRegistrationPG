CREATE TABLE IF NOT EXISTS public.usuarios
(
    id integer NOT NULL DEFAULT 'nextval('usuarios_id_seq'::regclass)',
    nome character varying(45) COLLATE pg_catalog."default" NOT NULL,
    sobrenome character varying(45) COLLATE pg_catalog."default" NOT NULL,
    cep character varying(45) COLLATE pg_catalog."default" NOT NULL,
    rua character varying(45) COLLATE pg_catalog."default" NOT NULL,
    bairro character varying(45) COLLATE pg_catalog."default" NOT NULL,
    cidade character varying(45) COLLATE pg_catalog."default" NOT NULL,
    uf character varying(45) COLLATE pg_catalog."default" NOT NULL,
    numero character varying(45) COLLATE pg_catalog."default" NOT NULL,
    complemento character varying(45) COLLATE pg_catalog."default",
    CONSTRAINT usuarios_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.usuarios
    OWNER to postgres;