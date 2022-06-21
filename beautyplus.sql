create database beautyplus;
use beautyplus;

create table user(
	id int primary key auto_increment,
    role varchar(10) not null,
    username varchar(100) not null,
    password varchar(100) not null,
    address varchar(200),
    phone varchar(15),
    fullname varchar(100),
    email varchar(100),
    created datetime default current_timestamp,
    updated datetime default current_timestamp on update current_timestamp,
    unique(username)
);

create table news(
	id int primary key auto_increment,
    title text,
    content text,
    author varchar(200),
    created datetime default current_timestamp,
    updated datetime default current_timestamp on update current_timestamp
);

create table category(
	id int primary key auto_increment,
    name varchar(100),
    description text,
    created datetime default current_timestamp,
    updated datetime default current_timestamp on update current_timestamp,
    unique(name)
);

create table product(
	id int primary key auto_increment,
    name varchar(100) not null,
    description text,
    quantity int,
    price int,
    sold int,
    disscount int,
	brand varchar(100),
    category_id int,
    created datetime default current_timestamp,
    updated datetime default current_timestamp on update current_timestamp,
    unique(name),
    foreign key (category_id) references category(id) on delete set null
);

create table bill(
	id int primary key auto_increment,
    user_id int,
    created datetime default current_timestamp,
    total int,
    status varchar(50),
    name varchar(100) not null,
    address varchar(200),
    phone varchar(15),
    email varchar(100),
    note text,
    foreign key (user_id) references user(id) on delete set null
);

create table bill_product(
	bill_id int not null,
    product_id int not null,
    quantity int,
    price int,
    primary key (bill_id, product_id)
);

create table image(
	id int primary key auto_increment,
    link text,
    news_id int,
	product_id int,
    category_id int,
    user_id int,
    foreign key (category_id) references category(id) on delete cascade,
    foreign key (news_id) references news(id) on delete cascade,
    foreign key (product_id) references product(id) on delete cascade,
    foreign key (user_id) references user(id) on delete cascade
);

create table cart(
	user_id int not null,
    product_id int not null,
    quantity int,
    primary key (user_id, product_id)
);