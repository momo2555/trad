<?php 

       	 require 'app/db.php';
       	 require 'app/movie.php';
       	 require 'app/word.php';
       	 $dbconnec = new db();
       	 $movies = Movie::get_all_movies();
       	 $dbconnec->test();
       	 //Word::read_xml();

       	 ?>



<!DOCTYPE html5 >
<html>
	<head>
 <title>

 </title>
 <link rel="stylesheet" type="text/css" href="Style/style.css">
 <link rel="stylesheet" type="text/css" href="Style/foundation-icons/foundation-icons.css">
 <link rel="stylesheet" type="text/css" href="Style/app.css">
	</head>
	<body>
       <header> 
       	<div id="banner">
         
       	 </div>




       </header> 
       <nav>
       	<ul>
       		<li>
       			<a href="">Accueil</a>
       		</li>
       		<li>
       			<a href="">Proposer un film</a>
       		</li>
       		<li>
       			<a href="">Vocabulaire</a>
       		</li>
       		<li>
       			<a href="">Administration</a>
       		</li> 
       	</ul>
       </nav>
       	 <div id="search-form"> 
       	 	<form>
       	 		<input type="text" name="search" id="search-input">
       	 		<button type="submit" id="search-button">
       	 			<i class="fi-magnifying-glass"> 

       	 			</i>
       	 		</button> 
       	 	</form>

       	 </div>



        <div id="content" > 
          <section>
          	<h2>
          		Last movies
          	</h2>

          	<div class="grid-x"> 



          	<?php
          		foreach($movies as $movie) {
          	?>
          	<div class="cell large-4 medium-6 samll-12 movie-part">
	          	<div class="movie-part-in" >
	          		<div class="movie-part-img">
	          			<img src="img/<?php echo $movie['Image']; ?> ">
	          		</div>
	          		
	          		<div class="movie-part-section">
		          		<h3><?php echo $movie['Title']; ?></h3>
		          		<p>
		          			<?php echo substr($movie['Description'], 0, 100); ?>...

		          		</p>
		          		
		          		<p>
		          			<?php echo $movie['Release_date']; ?>
		          		</p>
	          		</div>
	          	</div>

	          	</div>
	          	<?php
	          		}
	          	?>




          	</div>

          </section>

        </div>
       
       <footer>
       	
       </footer>

	</body>

</html>