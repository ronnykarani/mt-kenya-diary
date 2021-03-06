<?php
session_start();

if(!in_array("admin", $_SESSION['roles'])){
    header("Location:../login/");
}

if(!isset($_GET['pid'])){
    header("Location:../posts/");
}else{
    $_SESSION['postid'] = ($_GET['pid'])/85;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Meru Dairy</title>
        <link rel="icon" href="../../img/logo.png" type="image/png" />
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

         <!-- ckeditor to replace the textarea -->
        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>

        <style>
                        .require {
                color: #666;
            }
            label small {
                color: #999;
                font-weight: normal;
            }

            .card img{
                max-width:100%;
                height: auto;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <!-- navbar begin -->
         <?php require '../components/navbar.php'; ?>

<!-- nav bar end -->

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <!-- side nav begin -->
                <?php include '../components/sidenav.php'?>
                <!-- side nav end -->
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mt-4">
                            <li class="breadcrumb-item active">Edit Post</li>
                        </ol>
                        

        <div class="container">
            <div class="jumbotron">
            
            <div class="col-md-offset-2">
                
                <form action="" method="POST" id="edit-post-form">
                                                
                    
                    <div class="card mb-2">
                        <div class="card-header">
                            <label for="title">Title <span class="require">*</span></label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                        
                        <textarea class="form-control" name="title" id="title" maxlength="200" rows="2"></textarea>
                    </div>
                        </div>
                    </div>
                    
                    

                    <div class="card mb-2">
                        <div class="card-header">
                           <label for="category">Category <span class="require">*</span></label>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6 form-group " id="categories-cont">
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="new-category" minlength="3" name="new-category" placeholder="New Category">
                        </div>
                        </div>
                    </div>


                    <div class="card mb-2">
                        <div class="card-header">
                            <label for="main-image">Main Image <span class="require">*</span></label>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6" id="current-main-image">
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="main-image">Replace Image</label>
                            <input type="file" class="form-control-file" id="main-image" name="main-image" accept="image/*">
                        </div>
                        </div>
                    </div>

                 
                    <div class="card mb-2">
                        <div class="card-header">
                            <label for="title-description">Details title<span class="require">*</span></label>
                        </div>
                        <div class="card-body form-group">
                        
                        <textarea rows="5" class="form-control" name="details-title" id="details-title"></textarea>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            Images (select to delete)
                        </div>
                        <div class="card-body row" id="current-more-images">
                            
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            <label for="">Add More Images</label>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-4">
                            <input type="file" class="form-control-file" id="image-1" name="image-1" accept="image/*">
                            
                        </div>
    
                        <div class="form-group col-md-4">
                        <input type="file" class="form-control-file" id="image-2" name="image-2" accept="image/*">
                            
                        </div>
    
                        <div class="form-group col-md-4">
                            <input type="file" class="form-control-file" id="image-3" name="image-3" accept="image/*">
                        </div>
                        </div>
                    </div>
                        
                    

                    <div class=" card">
                        <div class="card-header">
                            <label for="details-description">Details description</label>
                        </div>
                        <div class="card-body form-group">

                            <textarea rows="5" class="form-control" name="details-description" id="details-description" ></textarea>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            quotes (select to delete)
                        </div>
                        <div class="card-body" id="current-quotes">
                            
                            
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            Add a quote
                        </div>
                        <div class="card-body">
                            <div class="form-group " id="quotes-cont">
                                
                            </div>
                            <p>
                                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#quoteInput" aria-expanded="false" aria-controls="quoteInput">
                                    New Quote
                                </button>
                            </p>
                            
                            <div class="collapse jumbotron" id="quoteInput">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                        <input class="form-control form-control-sm" id="author" name="author" type="text" placeholder="Author">
                                </div>
                                <div class="form-group">
                                    <label for="quote">Quote</label>
                                    <textarea rows="1" maxlength="200" class="form-control" name="new-quote" id="new-quote" ></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    

                    <div class="card mb-2">
                        <div class="card-header">
                            <label for="details-more-description">Details more description</label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                        
                        <textarea rows="5" class="form-control" name="details-more-description" id="details-more-description" ></textarea>
                    </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            Action`
                        </div>
                        <div class="card-body row">
                            <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="status" id="status-published" value="published">
                            <label class="form-check-label" for="publish" checked>Publish</label>
                            </div>
                            <div class="form-check col-md-6">
                            <input class="form-check-input" type="radio" name="status" id="status-hidden" value="hidden">
                            <label class="form-check-label" for="hide">hide</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                        <div class="text-danger edit-post-error" style="display:none"></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update Post
                        </button>
                        
                    </div>
                    
                </form>
            </div>
            
        </div>
</div>
                       
                        
                    </div>
                </main>
                <!-- footer begin -->
        <?php require '../components/footer.php'; ?>

                <!-- footer end -->
            </div>
        </div>

<!-- success modal start -->
<!-- Modal HTML -->
<div id="successModal" class="modal fade">
	<div class="modal-dialog success-modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>				
				<h4 class="modal-title w-100">Success!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center success-modal-text"></p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div> 
<!-- success modal end -->

        <script>
        // ckeditor to replace the textareas

            let title;
            let detailsTitle;
            let detailsDescription;
            let detailsMoreDescription;
            let newQuote;

        ClassicEditor
            .create( document.querySelector( '#title' ) )
            
            .then( editor => {
            title = editor;
        } ).
            catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector( '#details-title' ) )
            .then( editor => {
            detailsTitle = editor;
        } )
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector( '#details-description' ) )
            .then( editor => {
            detailsDescription = editor;
        } )
            .catch( error => {
                console.error( error );
            } );
            
            ClassicEditor
            .create( document.querySelector( '#details-more-description' ) )
            .then( editor => {
            detailsMoreDescription = editor;
        } )
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector( '#new-quote' ) )
            .then( editor => {
            newQuote = editor;
        } )
            .catch( error => {
                console.error( error );
            } );
    </script>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../js/utilities.js"></script>
        <script src="../js/edit-post.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

       
        
        
    </body>
</html>
