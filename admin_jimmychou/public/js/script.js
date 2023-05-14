
// Get the modal
var modal = document.getElementById("newModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.querySelectorAll(".close");

if(modal && btn && span){
    if (modal.dataset.display == 'true') {
        modal.style.display = 'block'
    } else if (modal.dataset.display == 'false') {
        modal.style.display = 'none'
    }
    
    
    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.forEach(item => {
        item.onclick = function () {
            if (item.dataset.modal == 'close') {
                modal.style.display = "none";
            }
        }
    
    })
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//---------------------------------------------------------------------------------------
let ARR_SEAT = new Array();
let indexArr = 0;
let arrTemp;
//Booking filter in map car
const seat_chart = document.querySelectorAll('.modal-body .map-car .map-content .desk');
const vehicle_seat = document.getElementById('vehicle_seat');

seat_chart.forEach((item) => {
    item.addEventListener('click', function (event) {
        let row = item.dataset.row*1;
        let col = item.dataset.col*1;
        let floor = 1;
        
        if (item.classList.contains('over')) {
            return;
        }
        item.classList.toggle('active');

        if(item.dataset.floor == '1' || item.dataset.floor == 2){
            floor = item.dataset.floor*1;
        }
        arrTemp = new Array(floor, row, col);

        if(item.classList.contains('active')){
            ARR_SEAT[indexArr] = arrTemp;
            indexArr++;
        }else{
            removeItemOnce(ARR_SEAT, [floor,row,col]);
            indexArr--;
        }

        vehicle_seat.value = indexArr;

        document.getElementById('diagram_seat').value = JSON.stringify(ARR_SEAT);
        console.log(ARR_SEAT);
    })
})
function removeItemOnce(arr, value) {
    for (var i = 0; i < arr.length; i++) {
        if (String(arr[i]) == String(value)) {
            arr.splice(i, 1);
        }
    }
    return arr;
}
if(typeof arr_diagram != "undefined"){
    editDiagram(arr_diagram);//Call func
}
//[[1,0,0],[1,1,0],[1,2,0],[1,3,0],[1,4,0],[1,3,2],[1,2,2],[1,1,2],[1,1,4],[1,2,4],[1,3,4],[1,4,4],[1,4,2]]
//Function: update diagram seat when user edit
function editDiagram(getDiagram){
    for (let i = 0; i < getDiagram.length; i++) {
        arrTemp = new Array(getDiagram[i][0],getDiagram[i][1],getDiagram[i][2])//Add 1 seat in array
        ARR_SEAT[indexArr] = arrTemp;
        indexArr++;
    }
    seat_chart.forEach(item => {
        for (let i = 0; i < ARR_SEAT.length; i++) {
            if(ARR_SEAT[i][0] == item.dataset.floor && ARR_SEAT[i][1] == item.dataset.row &&  ARR_SEAT[i][2] == item.dataset.col){
                item.classList.add('active');
            }
        }
    })
    document.getElementById('diagram_seat').value = JSON.stringify(ARR_SEAT);
}

//--------------------------Diagram seat -----------------------
const ONE_FLOOR = document.getElementById('floor_one');//Get diagram vehicle 1 floor
const TWO_FLOOR = document.getElementById('floor_two');//Get diagram vehicle 2 floor

//Get floor of user
const FLOOR = document.getElementById('vehicle_floor');


document.addEventListener('DOMContentLoaded', function(){
    if(FLOOR){
        checkFloor()
        FLOOR.onchange = () => {
            vehicle_seat.value = 0;
            ARR_SEAT = [];
            indexArr = 0;
            checkFloor();
            clearSeat();
        }
    }
})

function checkFloor(){
    if(FLOOR.value == 1){
        ONE_FLOOR.style.display = 'block';
        TWO_FLOOR.style.display = 'none';
    }else if(FLOOR.value == 2){
        TWO_FLOOR.style.display = 'block';
        ONE_FLOOR.style.display = 'none';
    }
}

function clearSeat(){
    seat_chart.forEach((item) => {
        item.classList.remove('active');
    })
}

//----------------------

// const vehicle_name = document.getElementById('vehicle_name');

// btnAddVehicle.onclick = (e)=>{
//     let vehicle_name_value = vehicle_name.value;
//     let license_plate = document.getElementById('license_plate').value;
//     let vehicle_seat = document.getElementById('vehicle_seat').value;
//     let vehicle_floor = document.getElementById('vehicle_floor').value;
//     let agency_id = document.getElementById('agency_id').value;

//     vehicle_name_value = ARR_SEAT;
//     // $.ajax({
//     //     url: '../../action/vehicle/add_vehicle.php',
//     //     type: 'post',
//     //     dataType: 'json',
//     //     contentType: false,
//     //     cache: false,
//     //     data: {
//     //         name: vehicle_name,
//     //         image: files,
//     //         license_plate: license_plate,
//     //         seat: vehicle_seat,
//     //         floor: vehicle_floor,
//     //         agency: agency_id,
//     //         diagram: ARR_SEAT
//     //     }
//     // }).done(function (reponse) {
//     //     console.log(reponse);
//     // });
// }