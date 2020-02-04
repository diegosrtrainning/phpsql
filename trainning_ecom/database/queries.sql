-- Order by
select
	*
from
	trainning_ecom_oficial.cliente
	order by nome;
	
-- Order by des
select
	*
from
	trainning_ecom_oficial.cliente
	order by nome desc;
	

select
	*
from
	trainning_ecom_oficial.cliente
	order by 3;
	
select
	*
from
	trainning_ecom_oficial.cliente
	order by nome, sobrenome desc;
	
select
	*
from
	trainning_ecom_oficial.cliente
	order by nome desc
	limit 2;
	
select
	SQL_CALC_FOUND_ROWS nome, 
	nome
from
	trainning_ecom_oficial.cliente	
	order by nome
	limit 2 OFFSET 1; 

SELECT FOUND_ROWS();

select
	*
from
	trainning_ecom_oficial.cliente
	where data_nascimento > '2000-01-01'
	order by nome;

select
	*
from
	trainning_ecom_oficial.cliente
	where data_nascimento < '2000-01-01'
	order by nome;

select
	*
from
	trainning_ecom_oficial.cliente
	where data_nascimento >= '2000-01-01' 
	and data_nascimento <= '2012-01-01'
	order by nome;

select
	*
from
	trainning_ecom_oficial.cliente
	where data_nascimento between '2000-01-01' and '2012-01-01'
	order by nome;

select
	c.*
from
	trainning_ecom_oficial.categoria c
	where c.nome = 'Informática' 
	or c.nome = 'teste'; 

select
	c.*
from
	trainning_ecom_oficial.categoria c
	where c.nome like '%r%'; 

select 
	c.nome as 'categoria',
	count(c.id_categoria) as 'total' 
from 
	trainning_ecom_new.produto p
	inner join trainning_ecom_new.categoria c on p.id_categoria = c.id_categoria 
	group by c.nome;


select 
	c.nome as 'categoria',
	count(c.id_categoria) as 'total'	
from 
	trainning_ecom_new.produto p
	inner join trainning_ecom_new.categoria c on p.id_categoria = c.id_categoria 
	group by c.nome having count(c.id_categoria) > 2;


select 
	c.nome as 'categoria',
	sum(p.valor) as 'total' 
from 
	trainning_ecom_new.produto p
	inner join trainning_ecom_new.categoria c on p.id_categoria = c.id_categoria 
	group by c.nome;	



start transaction;
INSERT INTO trainning_ecom_oficial.categoria
(nome)
VALUES('Outros');

select * from trainning_ecom_oficial.categoria;

-- rollback;
-- commit;


use trainning_ecom_oficial;
select id_cliente as id, nome, email from cliente
union
select id_usuario as id, nome, email from funcionario;