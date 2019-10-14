SELECT id_genre, genre.name AS 'name_genre', id_distrib, distrib.name AS 'name_distrib', title AS 'title_film'
FROM film 
JOIN genre USING (id_genre)
JOIN distrib USING (id_distrib)
WHERE id_genre BETWEEN 4 AND 8;