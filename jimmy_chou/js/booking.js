//
const booking_car = document.querySelectorAll('.booking-car');

if(booking_car){
    booking_car.forEach(item => {
        item.addEventListener('click', function(event){
            event.preventDefault();
            let ticket_id = event.target.dataset.ticket;
            $.ajax({
                url: 'ajax_select_ticket.php',
                type: 'get',
                dataType: 'json',
                data: {
                    ticket_id: ticket_id
                }
            }).done(function (reponse){
                console.log(reponse['floor']);
                var floor_two =document.getElementById('floor_two');
                if(floor_two){
                    if(reponse['floor'] === 1){
                        floor_two.style.display = 'none';
                    }else {
                        floor_two.style.display = 'block';
                    }
                }

                $.ajax({
                    url: 'ajax_select_ticket.php',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        ticket_id: ticket_id
                    }
                }).done(function (reponse){
                    console.log(reponse['floor']);
                    var floor_two =document.getElementById('floor_two');
                    if(floor_two){
                        if(reponse['floor'] === 1){
                            floor_two.style.display = 'none';
                        }else {
                            floor_two.style.display = 'block';
                        }
                    }
                });
            });
            
        })
    })
}