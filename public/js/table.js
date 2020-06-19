var tab = $('#tabledata');

async function init() {
    const url = window.location.href;
    const response = await fetch(url +  'event/booking/0/30', {
        method: 'GET',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json',
        },
    });
    return response.json();
}

init()
    .then(data => {
        console.log(data)
        let tab = $('#tabledata');
        let totalFee = 0;
        for (let i=0; i < data.length; i++) {
            let newRow = "<tr>";
            newRow += `<td>${data[i]['participation_id']}</td>`;
            newRow += `<td>${data[i]['employee_name']}</td>`;
            newRow += `<td>${data[i]['employee_mail']}</td>`;
            newRow += `<td>${data[i]['event_id']}</td>`;
            newRow += `<td>${data[i]['event_name']}</td>`;

            totalFee += parseFloat(data[i]['participation_fee']);

            newRow += `<td>${data[i]['event_date']}</td>`;
            newRow += `<td>${data[i]['version']}</td>`;
            newRow += `<td>${data[i]['participation_fee']}</td>`;
            tab.append(newRow);
        }
        console.log(totalFee.toFixed(2));
        $('.total').parent().children('td').html(`${totalFee.toFixed(2)}`)
    });

$('#searchInput').on('keyup', function () {
    let value = $(this).val().toLowerCase();
    let searchOn = $('#searchId').val();
    let totalFee = 0;


    let tableRows = $('#tabledata tr');
    for (let i=0; i < tableRows.length; i++) {
        let td;
        if (searchOn === 'Employee') {
            td = tableRows[i].getElementsByTagName('td')[1];
        } else if (searchOn === 'Event Name') {
            td = tableRows[i].getElementsByTagName('td')[4];
        } else if (searchOn === 'Date') {
            td = tableRows[i].getElementsByTagName('td')[5];
        }

        if (td) {
            let textVal = td.textContent || td.innerText;
            if (textVal.toLowerCase().indexOf(value) > -1) {
                tableRows[i].style.display = '';
                totalFee += parseFloat(tableRows[i].getElementsByTagName('td')[7].innerHTML)
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    }
    console.log("totalfee = ", totalFee);
    $('.total').parent().children('td').html(`${totalFee.toFixed(2)}`);
});