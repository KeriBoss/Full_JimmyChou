const oneway = document.querySelector('#oneway');
const roundway = document.querySelector('#roundway');
const roundwayForm = document.querySelector('#round-way');

roundway.onclick = ()=>{
    var trip_type = document.querySelector('.trip_type');
    if(roundway.checked == true){
        roundwayForm.classList.remove('notShow');
        trip_type.value = 0;
    }
    else if(roundway.checked == false){
        roundwayForm.classList.add('notShow');
    }
}
oneway.onclick = ()=>{
    var trip_type = document.querySelector('.trip_type');
    if(oneway.checked == true){
        roundwayForm.classList.add('notShow');
        trip_type.value = 1;
    }
    else if(roundway.checked == false){
        roundwayForm.classList.remove('notShow');
    }
}
if(oneway && roundway){
    var trip_type = document.querySelector('.trip_type');
    if(oneway.checked === true){
        if(trip_type){
            trip_type.value = 1;
        }
    }else if(roundway.checked === true){
        if(trip_type){
            trip_type.value = 0;
        }
    }
}
const btnShowFilter = document.querySelector('#btn-show-filter');

function showFilter(){
    if(btnShowFilter){
        if(window.innerWidth <= 991.98){
            document.querySelector('#filter-ticket').classList.remove('show');
            btnShowFilter.style.display = 'block'
        }
        if(window.innerWidth >= 991.98){
            btnShowFilter.style.display = 'none'
        }
    }
}
showFilter();

//Booking filter in map car
const seat_chart = document.querySelectorAll('.modal-body .map-car .map-content .desk');

seat_chart.forEach(item => {
    item.addEventListener('click', function(event){
        if(item.classList.contains('over')){
            return;
        }
        item.classList.toggle('active');
    })
})

//booking ticket drop date
const bookingDrop = document.getElementById('choose_drop_date');
const boxLocation = document.querySelectorAll('.box-location .box');

if(bookingDrop && boxLocation){
    bookingDrop.addEventListener('click',function(event){
        boxLocation.forEach(item => {
            item.classList.add('active');
            if(item.classList.contains('box-right')){
                item.querySelector('a').style.visibility = 'visible';
            }
        })
    })
}

//-------------------------------User-------------------------------------

const btnChooseTransport = document.getElementById('pick_option_rental');
var itemTran = btnChooseTransport.querySelectorAll('.nav-item .nav-link');
if(itemTran){
    itemTran.forEach(item => {
        item.addEventListener('click', function(){
            var pane = document.querySelectorAll('.tab-content .tab-pane');
            pane.forEach(data => {
                var transport_id = data.querySelector('.transport_id');
                if(transport_id){
                    transport_id.value = item.querySelector('.value_transport').value;
                }
            })
            var temp = item.querySelector('.value_trip_type').value;
                setTripType(temp);
        })
    })
}

function getTransportId(){
    if(btnChooseTransport){
        var itemTran = btnChooseTransport.querySelectorAll('.nav-item .nav-link');
        itemTran.forEach(item => {
            if(item.classList.contains('active')){
                var pane = document.querySelectorAll('.tab-content .tab-pane');
                pane.forEach(data => {
                    var transport_id = data.querySelector('.transport_id');
                    if(transport_id){
                        transport_id.value = item.querySelector('.value_transport').value;
                    }
                })
                var temp = item.querySelector('.value_trip_type').value;
                setTripType(temp);
            }
        })
    }
}
getTransportId();
const search_submit = document.getElementById('search_submit');

function setTripType(value){
    var pane = document.querySelectorAll('.tab-content .tab-pane');
    pane.forEach(data => {
        var trip_type = data.querySelector('.trip_type');
        if(trip_type){
            trip_type.value = value;
        }
    })
}

$('#start_date').datepicker({
    startDate: "-0d",
    todayBtn: true,
    autoclose: true,
});
$('#start_date2').datepicker({
    startDate: "-0d",
    todayBtn: true,
    autoclose: true,
});
$('#end_date').datepicker({
    startDate: "-0d",
    todayBtn: true,
    autoclose: true,
});
$('#end_date2').datepicker({
    startDate: "-0d",
    todayBtn: true,
    autoclose: true,
});