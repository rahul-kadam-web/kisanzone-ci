PGDMP     '                    y         	   kisanzone    11.11    11.11 K    w           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            x           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            y           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            z           1262    16393 	   kisanzone    DATABASE     �   CREATE DATABASE kisanzone WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_India.1252' LC_CTYPE = 'English_India.1252';
    DROP DATABASE kisanzone;
             postgres    false            �            1259    16524    admin    TABLE     �  CREATE TABLE public.admin (
    admin_id integer NOT NULL,
    username character varying(20),
    password character varying(200),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    email character varying(50),
    CONSTRAINT admin_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.admin;
       public         postgres    false            �            1259    16522    admin_admin_id_seq    SEQUENCE     �   CREATE SEQUENCE public.admin_admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.admin_admin_id_seq;
       public       postgres    false    197            {           0    0    admin_admin_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.admin_admin_id_seq OWNED BY public.admin.admin_id;
            public       postgres    false    196            �            1259    16554    brand    TABLE     @  CREATE TABLE public.brand (
    brand_id integer NOT NULL,
    brand_name character varying(20),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    CONSTRAINT brand_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.brand;
       public         postgres    false            �            1259    16552    brand_brand_id_seq    SEQUENCE     �   CREATE SEQUENCE public.brand_brand_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.brand_brand_id_seq;
       public       postgres    false    203            |           0    0    brand_brand_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.brand_brand_id_seq OWNED BY public.brand.brand_id;
            public       postgres    false    202            �            1259    16544    category    TABLE     G  CREATE TABLE public.category (
    cat_id integer NOT NULL,
    category_name character varying(20),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    CONSTRAINT category_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.category;
       public         postgres    false            �            1259    16542    category_cat_id_seq    SEQUENCE     �   CREATE SEQUENCE public.category_cat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.category_cat_id_seq;
       public       postgres    false    201            }           0    0    category_cat_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.category_cat_id_seq OWNED BY public.category.cat_id;
            public       postgres    false    200            �            1259    33216 
   contact_us    TABLE     ;  CREATE TABLE public.contact_us (
    contact_id integer NOT NULL,
    name character varying(50),
    email character varying(50),
    mobile character varying(13),
    subject character varying(100),
    description character varying(500),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.contact_us;
       public         postgres    false            �            1259    33214    contact_us_contact_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contact_us_contact_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.contact_us_contact_id_seq;
       public       postgres    false    211            ~           0    0    contact_us_contact_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.contact_us_contact_id_seq OWNED BY public.contact_us.contact_id;
            public       postgres    false    210            �            1259    16534 	   customers    TABLE     v  CREATE TABLE public.customers (
    cus_id integer NOT NULL,
    fname character varying(20),
    lname character varying(20),
    email character varying(100),
    mobile character varying(100),
    password character varying(200),
    pin character varying(6),
    city character varying(20),
    state character varying(20),
    address character varying(50),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    verified_otp character varying(10),
    CONSTRAINT customers_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.customers;
       public         postgres    false            �            1259    16532    customers_cus_id_seq    SEQUENCE     �   CREATE SEQUENCE public.customers_cus_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.customers_cus_id_seq;
       public       postgres    false    199                       0    0    customers_cus_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.customers_cus_id_seq OWNED BY public.customers.cus_id;
            public       postgres    false    198            �            1259    16603    order_items    TABLE     �   CREATE TABLE public.order_items (
    order_item_id integer NOT NULL,
    order_id integer,
    pro_id integer,
    quantity integer,
    sub_total numeric(8,2),
    status integer DEFAULT 1
);
    DROP TABLE public.order_items;
       public         postgres    false            �            1259    16601    order_items_order_item_id_seq    SEQUENCE     �   CREATE SEQUENCE public.order_items_order_item_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.order_items_order_item_id_seq;
       public       postgres    false    209            �           0    0    order_items_order_item_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.order_items_order_item_id_seq OWNED BY public.order_items.order_item_id;
            public       postgres    false    208            �            1259    16588    orders    TABLE     N  CREATE TABLE public.orders (
    order_id integer NOT NULL,
    cus_id integer,
    grand_total numeric(8,2),
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    CONSTRAINT orders_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.orders;
       public         postgres    false            �            1259    16586    orders_order_id_seq    SEQUENCE     �   CREATE SEQUENCE public.orders_order_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.orders_order_id_seq;
       public       postgres    false    207            �           0    0    orders_order_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.orders_order_id_seq OWNED BY public.orders.order_id;
            public       postgres    false    206            �            1259    16565    products    TABLE     �  CREATE TABLE public.products (
    pro_id integer NOT NULL,
    name character varying(50),
    image character varying(300),
    price numeric(8,2),
    quantity integer,
    description character varying(1000),
    cat_id integer,
    brand_id integer,
    added_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_date timestamp without time zone,
    status integer DEFAULT 1,
    CONSTRAINT products_status_check CHECK ((status = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.products;
       public         postgres    false            �            1259    16563    products_pro_id_seq    SEQUENCE     �   CREATE SEQUENCE public.products_pro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.products_pro_id_seq;
       public       postgres    false    205            �           0    0    products_pro_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.products_pro_id_seq OWNED BY public.products.pro_id;
            public       postgres    false    204            �            1259    33261    recently_viewed_products    TABLE     �   CREATE TABLE public.recently_viewed_products (
    rvp_id integer NOT NULL,
    cus_id integer,
    pro_id integer,
    viewed_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status integer DEFAULT 1
);
 ,   DROP TABLE public.recently_viewed_products;
       public         postgres    false            �            1259    33259 #   recently_viewed_products_rvp_id_seq    SEQUENCE     �   CREATE SEQUENCE public.recently_viewed_products_rvp_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.recently_viewed_products_rvp_id_seq;
       public       postgres    false    213            �           0    0 #   recently_viewed_products_rvp_id_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.recently_viewed_products_rvp_id_seq OWNED BY public.recently_viewed_products.rvp_id;
            public       postgres    false    212            �
           2604    16527    admin admin_id    DEFAULT     p   ALTER TABLE ONLY public.admin ALTER COLUMN admin_id SET DEFAULT nextval('public.admin_admin_id_seq'::regclass);
 =   ALTER TABLE public.admin ALTER COLUMN admin_id DROP DEFAULT;
       public       postgres    false    197    196    197            �
           2604    16557    brand brand_id    DEFAULT     p   ALTER TABLE ONLY public.brand ALTER COLUMN brand_id SET DEFAULT nextval('public.brand_brand_id_seq'::regclass);
 =   ALTER TABLE public.brand ALTER COLUMN brand_id DROP DEFAULT;
       public       postgres    false    202    203    203            �
           2604    16547    category cat_id    DEFAULT     r   ALTER TABLE ONLY public.category ALTER COLUMN cat_id SET DEFAULT nextval('public.category_cat_id_seq'::regclass);
 >   ALTER TABLE public.category ALTER COLUMN cat_id DROP DEFAULT;
       public       postgres    false    201    200    201            �
           2604    33219    contact_us contact_id    DEFAULT     ~   ALTER TABLE ONLY public.contact_us ALTER COLUMN contact_id SET DEFAULT nextval('public.contact_us_contact_id_seq'::regclass);
 D   ALTER TABLE public.contact_us ALTER COLUMN contact_id DROP DEFAULT;
       public       postgres    false    210    211    211            �
           2604    16537    customers cus_id    DEFAULT     t   ALTER TABLE ONLY public.customers ALTER COLUMN cus_id SET DEFAULT nextval('public.customers_cus_id_seq'::regclass);
 ?   ALTER TABLE public.customers ALTER COLUMN cus_id DROP DEFAULT;
       public       postgres    false    198    199    199            �
           2604    16606    order_items order_item_id    DEFAULT     �   ALTER TABLE ONLY public.order_items ALTER COLUMN order_item_id SET DEFAULT nextval('public.order_items_order_item_id_seq'::regclass);
 H   ALTER TABLE public.order_items ALTER COLUMN order_item_id DROP DEFAULT;
       public       postgres    false    208    209    209            �
           2604    16591    orders order_id    DEFAULT     r   ALTER TABLE ONLY public.orders ALTER COLUMN order_id SET DEFAULT nextval('public.orders_order_id_seq'::regclass);
 >   ALTER TABLE public.orders ALTER COLUMN order_id DROP DEFAULT;
       public       postgres    false    207    206    207            �
           2604    16568    products pro_id    DEFAULT     r   ALTER TABLE ONLY public.products ALTER COLUMN pro_id SET DEFAULT nextval('public.products_pro_id_seq'::regclass);
 >   ALTER TABLE public.products ALTER COLUMN pro_id DROP DEFAULT;
       public       postgres    false    204    205    205            �
           2604    33264    recently_viewed_products rvp_id    DEFAULT     �   ALTER TABLE ONLY public.recently_viewed_products ALTER COLUMN rvp_id SET DEFAULT nextval('public.recently_viewed_products_rvp_id_seq'::regclass);
 N   ALTER TABLE public.recently_viewed_products ALTER COLUMN rvp_id DROP DEFAULT;
       public       postgres    false    212    213    213            d          0    16524    admin 
   TABLE DATA               i   COPY public.admin (admin_id, username, password, created_date, modified_date, status, email) FROM stdin;
    public       postgres    false    197   �]       j          0    16554    brand 
   TABLE DATA               Z   COPY public.brand (brand_id, brand_name, created_date, modified_date, status) FROM stdin;
    public       postgres    false    203   �^       h          0    16544    category 
   TABLE DATA               ^   COPY public.category (cat_id, category_name, created_date, modified_date, status) FROM stdin;
    public       postgres    false    201   ?_       r          0    33216 
   contact_us 
   TABLE DATA               i   COPY public.contact_us (contact_id, name, email, mobile, subject, description, created_date) FROM stdin;
    public       postgres    false    211   �_       f          0    16534 	   customers 
   TABLE DATA               �   COPY public.customers (cus_id, fname, lname, email, mobile, password, pin, city, state, address, created_date, modified_date, status, verified_otp) FROM stdin;
    public       postgres    false    199   �`       p          0    16603    order_items 
   TABLE DATA               c   COPY public.order_items (order_item_id, order_id, pro_id, quantity, sub_total, status) FROM stdin;
    public       postgres    false    209   Mc       n          0    16588    orders 
   TABLE DATA               d   COPY public.orders (order_id, cus_id, grand_total, created_date, modified_date, status) FROM stdin;
    public       postgres    false    207   �c       l          0    16565    products 
   TABLE DATA               �   COPY public.products (pro_id, name, image, price, quantity, description, cat_id, brand_id, added_date, modified_date, status) FROM stdin;
    public       postgres    false    205   �c       t          0    33261    recently_viewed_products 
   TABLE DATA               _   COPY public.recently_viewed_products (rvp_id, cus_id, pro_id, viewed_date, status) FROM stdin;
    public       postgres    false    213   Ah       �           0    0    admin_admin_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.admin_admin_id_seq', 80, true);
            public       postgres    false    196            �           0    0    brand_brand_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.brand_brand_id_seq', 106, true);
            public       postgres    false    202            �           0    0    category_cat_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.category_cat_id_seq', 26, true);
            public       postgres    false    200            �           0    0    contact_us_contact_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.contact_us_contact_id_seq', 11, true);
            public       postgres    false    210            �           0    0    customers_cus_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.customers_cus_id_seq', 112, true);
            public       postgres    false    198            �           0    0    order_items_order_item_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.order_items_order_item_id_seq', 76, true);
            public       postgres    false    208            �           0    0    orders_order_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.orders_order_id_seq', 66, true);
            public       postgres    false    206            �           0    0    products_pro_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.products_pro_id_seq', 61, true);
            public       postgres    false    204            �           0    0 #   recently_viewed_products_rvp_id_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.recently_viewed_products_rvp_id_seq', 95, true);
            public       postgres    false    212            �
           2606    16531    admin admin_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (admin_id);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public         postgres    false    197            �
           2606    16561    brand brand_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.brand
    ADD CONSTRAINT brand_pkey PRIMARY KEY (brand_id);
 :   ALTER TABLE ONLY public.brand DROP CONSTRAINT brand_pkey;
       public         postgres    false    203            �
           2606    16551    category category_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (cat_id);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public         postgres    false    201            �
           2606    33225    contact_us contact_us_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.contact_us
    ADD CONSTRAINT contact_us_pkey PRIMARY KEY (contact_id);
 D   ALTER TABLE ONLY public.contact_us DROP CONSTRAINT contact_us_pkey;
       public         postgres    false    211            �
           2606    16541    customers customers_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (cus_id);
 B   ALTER TABLE ONLY public.customers DROP CONSTRAINT customers_pkey;
       public         postgres    false    199            �
           2606    24917    customers mobile_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.customers
    ADD CONSTRAINT mobile_unique UNIQUE (mobile);
 A   ALTER TABLE ONLY public.customers DROP CONSTRAINT mobile_unique;
       public         postgres    false    199            �
           2606    16608    order_items order_items_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (order_item_id);
 F   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_pkey;
       public         postgres    false    209            �
           2606    16595    orders orders_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (order_id);
 <   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_pkey;
       public         postgres    false    207            �
           2606    16575    products products_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (pro_id);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public         postgres    false    205            �
           2606    33267 6   recently_viewed_products recently_viewed_products_pkey 
   CONSTRAINT     x   ALTER TABLE ONLY public.recently_viewed_products
    ADD CONSTRAINT recently_viewed_products_pkey PRIMARY KEY (rvp_id);
 `   ALTER TABLE ONLY public.recently_viewed_products DROP CONSTRAINT recently_viewed_products_pkey;
       public         postgres    false    213            �
           2606    16609 %   order_items order_items_order_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_order_id_fkey FOREIGN KEY (order_id) REFERENCES public.orders(order_id) ON DELETE CASCADE;
 O   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_order_id_fkey;
       public       postgres    false    209    2780    207            �
           2606    16614 #   order_items order_items_pro_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pro_id_fkey FOREIGN KEY (pro_id) REFERENCES public.products(pro_id) ON DELETE CASCADE;
 M   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_pro_id_fkey;
       public       postgres    false    209    2778    205            �
           2606    16596    orders orders_cus_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_cus_id_fkey FOREIGN KEY (cus_id) REFERENCES public.customers(cus_id) ON DELETE CASCADE;
 C   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_cus_id_fkey;
       public       postgres    false    199    207    2770            �
           2606    16581    products products_brand_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_brand_id_fkey FOREIGN KEY (brand_id) REFERENCES public.brand(brand_id) ON DELETE CASCADE;
 I   ALTER TABLE ONLY public.products DROP CONSTRAINT products_brand_id_fkey;
       public       postgres    false    2776    203    205            �
           2606    16576    products products_cat_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_cat_id_fkey FOREIGN KEY (cat_id) REFERENCES public.category(cat_id) ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.products DROP CONSTRAINT products_cat_id_fkey;
       public       postgres    false    201    205    2774            �
           2606    33268 =   recently_viewed_products recently_viewed_products_cus_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recently_viewed_products
    ADD CONSTRAINT recently_viewed_products_cus_id_fkey FOREIGN KEY (cus_id) REFERENCES public.customers(cus_id) ON DELETE CASCADE;
 g   ALTER TABLE ONLY public.recently_viewed_products DROP CONSTRAINT recently_viewed_products_cus_id_fkey;
       public       postgres    false    2770    213    199            �
           2606    33273 =   recently_viewed_products recently_viewed_products_pro_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recently_viewed_products
    ADD CONSTRAINT recently_viewed_products_pro_id_fkey FOREIGN KEY (pro_id) REFERENCES public.products(pro_id) ON DELETE CASCADE;
 g   ALTER TABLE ONLY public.recently_viewed_products DROP CONSTRAINT recently_viewed_products_pro_id_fkey;
       public       postgres    false    2778    205    213            d   �   x�U�Mo�@����+\��Έ3ê�i(���&77��|�
(�ަ�Iݝ�I�G(r�}[��f��nց��������rgJ��fB~�����39���{0���%�~G�(�!�C���=&&)g�lB�F�͡�q�%(%߲���JK���ϰM'i�u�.��1S�A�֧JW]\���$�l�W��߻���o`��8c��x1��_�ǲ���Mm      j   U   x�e˱�0�:����q.������@HP���4�!Q���Zhh!��^��T5jK��O�C��Ժ�_}��RD���      h   c   x�e˱� ��p��� � &�`�$���^;�_H�g/y�\��Ð3�	A	�=bH/�	,<�O
PKi��*��Y<YG�?
��7���De      r      x����n�0Dk���Xl��I��S���ـ6F�	���q��J�fgF�ռ��ѴYx���_);��~���1�*��JJ���tonM��D��� d-D�t�&���l��k{Z��}iH�[����7j�	��x��T�*�؊�-�+%d���p�ɭV�
:���;Ї��IC�D}�-> x(�R����U���3�	^��;��4�����o�g����ǻ�-���U�e�U.�nD�uy�e�p|�      f   {  x����n�0�y�,���q���$�[�2�ԍi����-}�1�f�JU���9:R�O�9a0�Q����OAq.r^���\#���a��D~ާ��=��f��i�� �������.G�o��;�h�]���7��$K��{�<+}Ns��<��E�\w��P��Q<��{`�#^�2�
�J�r�ciՅ0��*�
�0j!�"P�X��~n�-�"�����7�w�Lg���#�*Hf\`�=� ���^��:i޷�|��ʩ�G�-�!��-�tW��)Yx������f���ka" �F#��"�gf���5q�N��x�{��s~H��m��86=��W:�wN�`�u�|��^O��R^��Q�w���P�a�Y�Nd�e��A�3���G��I�m�,�gy�C����T��%>�Tg
b�-aS��	T�"4�1���/J��ت��Z����i6��F�O�:�a��O��I�4����Z�;��;�X�g*�=w:Z����/���W�i��ZD�)!�X�'G (�:Q"�ϓ��b�l���ax�~���˴�k��)���9x����aѬ&گmx����_�=����l�Y�珞����U�(T.-&���S��1#
m<ɍF�,�9�      p   /   x�-ȱ  �:�
a��C��i�Q�L)$�cب���'H^��      n   J   x�e˱�@����g�{���Cc�w6O(n�B'��q��U{?�}���r��5:�
��6U} ��N      l   K  x�mUMo�6=+�b.�E)[���"=�XM�ݢ�,0�H�F"U�����}���]��%5��޼�z�}�u�j����nH�vB��}���00]�z�O쨬��n�nr�b]�r�r!ף�8������j#
!2�}�=)j3��=hӝ��7:��.��3&g���LC�k;�ln(X�=�[�qz�6ө��!��v�ʑ��:��z�����=�ێ��6�=��-8o���C�ݞ0.��-��!�L���/2)��:+E)s�ʅ$y�[_��e�^�j�&tI�ܭ�Nn3y�.�/����l:]�IF*�ڽ����[�"Aw8B$��f��}�d>S5Ӡ�B�?���&E��S����=5ڳ��aZ��؟�	{A��O{vG�m��A��3q?̤ȶ�G�H�,�vs�3BFV�m��!�3���K�m�b%��Qc:��ӣ2�W��;���!�O��h��9:�>=�J�I��nUB^l�ٷ�X�̮�Ȕ����U*Q�x��_WzqM<gYZ�B�oT\����Ni��ˎ�1�_6Ѡ�{0G����Y<O��Ω	OQ�F�,�۶M�WO����w�k�͎ů���ׅ�\�*�ZI*˝�xΪ2�� �q���;N�?��0;&ʩ�J:5"vh�ex�k{�Ge�#߿�>��SF�9dGkyj����i4j�V��i�n�O������}ܜr��\W�5�`���� ��%�-s��g�_�}��yL���H�[L�up�����)>ʕ����z6/k�umj���.cA�z5H��ܶh�8���Pm3�^v֢N���T��{�&�[��2��Y�_4���J�0�_P�8#!G�
?@�@'�1}lQ�P�:�qV��/}82�e	GA�Wp�<6�p��{��i;����*L�#>#�3>����w�r��-�QZ�$�	H�6O,}��/%�S���m�.���1]-s�:�~p9��<�p�9�0�PO�T���ԡH�/��t���?Z.3L��v��YN{��q�F ���Z��^����ʝR�Dj<�gS�6&�1��G�?�RR���$�4l�����1�+X�[qvv�?�p��      t   �   x�mл1D�خ�БF[������&��=/���L�d}�<��Y���V�aG�S1[���h���ߔ�i��*N˾���4(���H8J~��1���/5���')�B�JE�b)�;S�L����b�Ìb$�6���4�~jv���,��<��/꽿O�Dp     