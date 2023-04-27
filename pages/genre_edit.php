<div class="container" style="height:100vh">
   <div class="row d-flex text-start justify-content-center my-3">
        <div class="col-md-6">
            <form method="post">
            <div class="mb-3">
                    <label for="idGenre" class="form-label">Genre ID</label>
                    <input type="text" class="form-control" id="idGenre" maxlength="45"   placeholder="Genre ID" readonly value="<?php echo($genre->getId()); ?>">
                </div>
                <div class="mb-3">
                    <label for="namaGenre" class="form-label">Genre Name</label>
                    <input type="text" class="form-control" name="textName" id="namaGenre" maxlength="45" required autofocus value="<?php echo($genre->getName()); ?>" placeholder="Genre Name">
                </div>
                <button type="submit" class="btn btn-primary" name="btnUpdate">Update Data</button>
            </form>
        </div>
    </div>
</div>