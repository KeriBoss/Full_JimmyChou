<?php
include "./header.php";
require_once "../model/agency.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}

$agency = new Agency();
$getAgencyById = $agency->getAgencyById($id);
//get all location in database
$getAllAgency = $agency->getAllAgency();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa hãng phương tiện</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="<?= $url ?>/action/agency/edit_agency.php" method="post" class="w-50" enctype="multipart/form-data">
                <input type="number" name="agency_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <label for="">Tên hãng</label>
                    <input value="<?=$getAgencyById[0]['agency_name']?>" class="form-control" name="agency_name"
                        placeholder="Tên hãng ..." required>
                </div>
                <div class="form-group">
                    <label for="">Chọn hình ảnh</label>
                    <img height="400px" width="auto" src="<?=$urlImg?>/images/agency/<?=$getAgencyById[0]['img_logo']?>" id="img_thumbnail" alt="<?=$getAgencyById[0]['img_logo']?>">
                    <input id="change_img" type="file" name="thumbnail" class="form-control" value="<?=$getAgencyById[0]['img_logo']?>">
                    <input type="text" value="<?=$getAgencyById[0]['img_logo']?>" name="name_img_product" hidden>
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea class="form-control" name="description"><?=$getAgencyById[0]['description']?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Chỉnh Sửa</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    for (var i = 0; i < document.querySelectorAll('.optionDiv').length; i++) {
    if ( document.querySelectorAll('.optionDiv')[i].value == '<?=$getLocationById[0]['status'];?>') {
        document.querySelectorAll('.optionDiv')[i].selected = true;
        break;
    }
}
</script>
<script>
        var reader;
        let change_img = document.querySelector("#change_img");
        let img_thumbnail = document.querySelector("#img_thumbnail");
        change_img.onchange = e => {
            files = e.target.files;
                reader = new FileReader();
                reader.onload = function() {
                    document.querySelector("#img_thumbnail").src = reader.result;
                    document.querySelector('#img_thumbnail').style = 'height: 400px;';
                }
                reader.readAsDataURL(files[0]);
        }
    </script>
<?php
include "./footer.php";
?>