SELECT film.id_genre, genre.name AS 'name_genre',
film.id_distrib, distrib.name AS 'name_distrib', film.title AS 'title_film'
FROM film
JOIN genre USING (id_genre)
JOIN distrib USING (id_distrib)
WHERE film.id_genre BETWEEN 4 AND 8;