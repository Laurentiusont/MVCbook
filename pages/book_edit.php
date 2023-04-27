<div class="container" style="height:auto">
   <div class="row d-flex text-start justify-content-center my-3">
        <div class="col-md-6">
            <form method="post">
            <div class="mb-3">
                <label for="ISBNNum" class="form-label">ISBN</label>
                <input type="text" class="form-control" name="ISBN" id="ISBNNum" maxlength="13" readonly value="<?php echo($book->getIsbn()); ?>" placeholder="ISBN">
            </div>
            <div class="mb-3">
                <label for="bookTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="bookTitle" maxlength="100" required autofocus value="<?php echo($book->getTitle()); ?>" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="authorBook" class="form-label">Author</label>
                <input type="text" class="form-control" name="author" id="authorBook" maxlength="100" required autofocus value="<?php echo($book->getAuthor()); ?>" placeholder="Author">
            </div>
            <div class="mb-3">
                <label for="bookPublisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="bookPublisher" maxlength="100" required autofocus value="<?php echo($book->getPublisher()); ?>" placeholder="Publisher">
            </div>
            <div class="mb-3">
                <label for="pubYear" class="form-label">Publish Year</label>
                <input type="number" class="form-control" name="publishYear" id="pubYear"  required autofocus value="<?php echo($book->getYear()); ?>" placeholder="Publish Year">
            </div>
            <div class="mb-3">
                <label for="shortDesc" class="form-label">Short Description</label>
                <textarea  rows="4" type="textarea" class="form-control" name="shortDesc" id="shortDesc" maxlength="300" required autofocus >
                <?php echo ($book->getDescription()); ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="idGenre" class="form-label">Genre Name</label>
                <select class="form-select" name="idGenre" aria-label="Default select example" required>
                <?php
                    /**  @var $genre \entity\Genre */
                    foreach($result as $genre ){
                        echo '<option value="'. $genre->getId().'"'. (($book->getGenre()->getId() ==  $genre->getId())?'selected="selected"':"").'>'.$genre->getName().'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="btnUpdate">Update Data</button>
            
            </form>
            <div class="container" style="height:100vh">
                <div class="row d-flex text-start justify-content-center my-3">
                    <div class="col-md-6 text-center">
                        <h1>Change Cover</h1>
                        <?php
                        if ($book->getCover() != '') {
                            echo '<img class="rounded-3" src="uploads/' . $book->getCover() . '" style="width:100%;height:auto;max-width:500px;max-height:500px; text-align:center;">';
                        }
                        else{
                            echo '<img class="rounded-3" src="uploads/default.jpg" style="width:100%;height:auto;max-width:500px;max-height:500px; text-align:center;">';
                        }
                        ?>
                        <form method="post" enctype="multipart/form-data">

                            <div class="mb-3">
                                <input type="file" class="form-control my-3" name="txtFile" accept="image/jpg">
                            </div>
                            <button type="submit" class="btn btn-dark w-100 text-warning" name="coverUpload">Change Cover</button>

                        </form>
                    </div>


                </div>
            </div>
        </div>
        
       
    </div>
</div>