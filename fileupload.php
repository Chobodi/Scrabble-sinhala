
<?php include('header.php');?>
<style type="text/css">
	#suggestwords{
		margin-left: 0%;
		margin-top: 2%;
	}
	#redcontent2{

		width: 175%;
	}

	#redcontent1{

		width: 100%;
	}
</style>
<body>

<div class="container " id="suggestwords" style="background-image: url('assets/img/scrabble.jpg')" >
    <div class="row">
    	<div id="redcontent1">
      <div class="col s6" >
        <div class="card-panel blue lighten-5">
          
                            <div class="header">
                                <h4 class="title  blue lighten-4 center">Suggest  Word File</h4>
                            </div>

          <div class="row">
          
            <p><center>Available file extension : <b> .TXT</b></center></p><br>

            <form action='fileupload.php?action=fp' method='POST' enctype="multipart/form-data">

            <div class="form-group center">
              
               <input id="btnfile" type='file' class="waves-effect  waves-light btn " name='image' value='Choose File' />
              
            </div>
            <br>
            <div class="center">
              <input id="btnprof2" type='submit' class="waves-effect blue waves-light btn " name='change_profile' value='Upload' />
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
								echo $book['COMBINATION'];
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

 if(isset($_POST['change_profile'])){

      $errors=array();
      $allowed_e=array('txt');

      $file_name=$_FILES['image']['name'];
      $file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
      $file_s=$_FILES['image']['size'];
      $file_tmp=$_FILES['image']['tmp_name'];

      if(in_array($file_e,$allowed_e)===false){
        $errors[]='This file extension is not allowed';
      }
      
      if(empty($errors)){
        move_uploaded_file($file_tmp, 'files/'.$file_name);
        $image_up='files/'.$file_name;

        echo 'Success';
      }else{
        foreach ($errors as $error) {
          echo $error.'<br>';
        }
      }

    }


?>

