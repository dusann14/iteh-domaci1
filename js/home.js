function pretrazi() {

    event.preventDefault();

    let text = $('#myInput')[0].value;

    if(text == ""){
        alert("Unesite autora")
        return
    }

    $('.tableBody').empty()
    $('#myInput').val("")


    $.post("handler/getByAutor.php", "autor=" + text, function (data) {
        let array = data.split("}")
        array.pop()
        array.forEach(element => {
            element = element + "}"
            let obj = JSON.parse(element)

            $('.tableBody').append(`
            <tr id = 'knjiga-${obj.knjigaId}'>
					<th scope="row">${obj.knjigaId}</th>
					<td>${obj.naslov}</td>
					<td>${obj.autor}</td>
					<td>${obj.godinaNastanka}</td>
                    <td>${obj.cena}</td>
                    <td class="radio"><input type="radio" name = "izaberi" value= ${obj.knjigaId}></td>					  
				</tr>
        `)

        });
    })
}

function sortiraj() {

    event.preventDefault();

    $('.tableBody').empty()
    
    $.get("handler/sort.php", function (data) {
        
        let array = data.split("}")
        array.pop()
        
        array.forEach(element => {
            element = element + "}"
            let obj = JSON.parse(element)

            $('.tableBody').append(`
            <tr id = 'knjiga-${obj.knjigaId}'>
					<th scope="row">${obj.knjigaId}</th>
					<td>${obj.naslov}</td>
					<td>${obj.autor}</td>
					<td>${obj.godinaNastanka}</td>
                    <td>${obj.cena}</td>
                    <td class="radio"><input type="radio" name = "izaberi" value= ${obj.knjigaId}></td>					  
				</tr>
        `)

        });
    })
}