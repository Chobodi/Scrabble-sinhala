
<?php include('header.php');?>
<style type="text/css">
	#suggestwords{
		margin-left: 0%;
		margin-top: 2%;
	}
	#redcontent2{

		width: 150%;
	}

	#redcontent1{

		width: 100%;
	}
  #tab15{ 
    padding-left: 52%; 
  }
</style>
<body>

<div class="container " id="suggestwords" style="background-image: url('')" >
    <div class="row">
    	<div id="redcontent1">
      <div class="col s6" >
        <div class="card-panel blue lighten-5">
          
                            <div class="header">
                                <h4 class="title  blue lighten-4 center">Suggest  Word </h4>
                            </div>

          <div class="row">
          
            <p><center>You can suggest maximum 3 words : <b> </b></center></p><br>


            <form action="fileupload.php" method="POST">
          <div class="form-group ">
                       Word 1 :
                    <input id="word1" name="word1" type="text" value="<?php //echo $email?>">
                       word 2 :
                    <input id="word2" name="word2" type="text" value="<?php //echo $address?>">
                       word 3 :
                    <input id="word3" name="word3" type="text" value="<?php //echo $phone?>">
                    
         </div>


          <div class="form-group center">
              <input id="submit_word" type='submit' class="waves-effect blue waves-light btn " name='submit_word' value='submit' />
            </div>
        </form>
                     
          </div>
        
        </div>
    </div>
    </div>

  <div id="redcontent2">
<div class="col s6" >
        <div class="card-panel blue lighten-5">
          
                            <div class="header">
                                <h4 class="title  blue lighten-4 center"> Dictionary</h4>
                            </div>
                            <p>
                            	<?php

								$g_books = array();
								$g_elem = null;
								 
								function startElement( $parser, $name, $attrs ) 
								{
								global $g_books, $g_elem;
								if ( $name == 'WORD' ) $g_books []= array();
								$g_elem = $name;
								}
								 
								function endElement( $parser, $name ) 
								{
								global $g_elem;
								$g_elem = null;
								}
								 
								function textData( $parser, $text )
								{
								global $g_books, $g_elem;
								if ( $g_elem == 'COMBINATION' )
								{
								$g_books[ count( $g_books )+1  ][ $g_elem ] = $text;
								}
								}
								 
								$parser = xml_parser_create();
								 
								xml_set_element_handler( $parser, "startElement", "endElement" );
								xml_set_character_data_handler( $parser, "textData" );
								 
								$f = fopen( 'all_words.xml', 'r' );
								 
								while( $data = fread( $f, 4096 ) )
								{
								xml_parse( $parser, $data );
								}
							
								xml_parser_free( $parser );
              
                foreach( $g_books as $book )
                {
                  for($i=0;$i<8;$i++){
              echo $book['COMBINATION'].'         ,';
                  }
                  echo '<br>';
                }
               
								 
                 
								?>

                            	
                            </p>

          <div class="row">
          
           

            <form action='fileupload.php?action=fp' method='POST' enctype="multipart/form-data">

            
            

            </form>
                     
          </div>
        
        </div>
    </div>

    </div>
</div>
</div>
</body>
</html>

<?php
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
$word1 =$_POST['word1'];
$word2 =$_POST['word2'];
$word3 =$_POST['word3'];



if(isset($_POST['submit_word'])){

if(empty($word1) && empty($word2) && empty($word3)){
  echo 'please add words';

}else{
  require('connection.php');
  $sql8="INSERT INTO suggest_word(word1,word2,word3)VALUES('".$word1."','".$word2."','".$word3."')";

  if(mysqli_query($con,$sql8)){ 
    echo 'success';
  }
 
    }

  }//submit
}
?>

