
function dodaj(){

    event.preventDefault();

    let inputs = $(".tableBody tr:last td input");
    
    let naslov = inputs[1].value;
    let autor = inputs[2].value;
    let godina = inputs[3].value;
    let cena = inputs[4].value;

    const string = "naslov=" + naslov + "&" + "autor=" + autor + "&" + "godinaNastanka=" + godina + "&" + "cena=" + cena;
   
    request = $.ajax({
        url: "handler/addBook.php",
        type: "post",
        data: string
    });

    request.done(function (response, textStatus, jqXHR) {
        
        response = response.split(" ")

        if (response[0] === "Success") {
            alert("Knjiga je dodata")
            append(response[1]);
        } else {
            alert("Knjiga nije dodata, popunite sva polja")
        }
    })

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Desila se greska: " + textStatus, errorThrown)
    }) 
}

function append(id){

    let lastRow = $(".tableBody tr:last");
    let lastButton = $(".tableBody tr:last td button");

    lastRow[0].id = id;
    lastButton[0].id = "dugme " + id;

    $(".tableBody").append(`
    <tr class="id" data-id="0" class="hidden" >
    <td style = "display: none" data-name="id">
        <input type="text" name='id' class="form-control"  readonly = "true"/>
    </td>
    <td data-name="name">
        <input type="text" name='name'  placeholder='Naslov' class="form-control" />
    </td>
    <td data-name="autor">
        <input type="text" name='autor' placeholder='Autor' class="form-control" />
    </td>
    <td data-name="godina">
         <input type="text" name='godina' placeholder='Godina' class="form-control" />
    </td>
    <td data-name="cena">
        <input type="text" name='cena' placeholder='Cena' class="form-control" />
    </td>
    <td data-name="del">
        <button onclick="obrisi(this.id)" name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
    </td>
    </tr>
    `)

}

function obrisi(id){
  
    event.preventDefault();

    id = id.split(" ");

    request = $.ajax({
        url: "handler/deleteBook.php",
        type: "post",
        data: "knjigaId=" + id[1]
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            alert("Knjiga je obrisana");
            $(`#${id[1]}`).remove()
        } else {
            alert("Knjiga nije obrisana")
        }
    })

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Desila se greska: " + textStatus, errorThrown)
    }) 

}