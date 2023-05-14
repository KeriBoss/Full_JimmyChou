
const btnEdit = document.querySelectorAll('.btnEdit');
const modalEdit = document.getElementById('newModal');
$(document).ready(function () {
    btnEdit.forEach(item => {
        item.onclick = (e)=>{
            let location_id = item.dataset.id;
            $.ajax({
                url: '../../action/location/edit_location.php',
                type: 'get',
                dataType: 'json',
                data: {
                    location_id: location_id
                }
            }).done(function (reponse) {
                modalEdit.innerHTML = ``;
                modalEdit.innerHTML += `
                <div id="newModal" class="modal1" data-display="false">
                <div class="modal-content">
                    <form action="<?=$url?>/action/location/add_location.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm địa điểm</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm xuất phát</b></label>
                                <div class="g-location">
                                <input class="form-control" list="GFGOptions" id="GFGDataList" name="location_pick"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="GFGOptions">
                                    <option value="Ho Chi Minh, Ho Chi Minh">
                                    <option value="Cho Noi Cai Rang, Can Tho">
                                    <option value="Binh Chanh District, Ho Chi Minh">
                                    <option value="Da Lat Terminal, Da Lat">
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm đến</b></label>
                                <div class="g-location">
                                <input class="form-control" list="option_drop" id="GFGDataList" name="location_drop"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="option_drop">
                                    <option value="Ho Chi Minh, Ho Chi Minh">
                                    <option value="Cho Noi Cai Rang, Can Tho">
                                    <option value="Binh Chanh District, Ho Chi Minh">
                                    <option value="Da Lat Terminal, Da Lat">
                                </datalist>
                            </div>
                            <div class="form-group w-25">
                                <label for=""><b>Trạng thái</b></label>
                                <select name="status" class="form-control">
                                    <option value="1" selected>Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
                `;
            });
        }
    })
})