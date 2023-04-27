<div class="container" style="height:100vh">
   <div class="row d-flex text-start justify-content-center my-3">
        <div class="col-md-6 text-center">
            <h1>Change Cover</h1>
            <?php
            if ($book->getCover() != null) {
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
            <button type="submit" class="btn btn-dark w-100 text-warning" name="btnUpload">Upload File to Server</button>
            
            </form>
        </div>
        
       
    </div>
</div>