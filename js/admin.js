$(document).ready(function() {
    $("#add_row").on("click", function() {
     
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
  
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var td;
            var cur_td = $(this);
            
            var children = cur_td.children();
            

            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        

        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
});




   
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();


});


function dodaj(){

    event.preventDefault();

    let inputs = $("#add td input");
    
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
        if (response === "Success") {
            alert("Knjiga je dodata")
        } else {
            alert("Knjiga nije dodata")
        }
    })

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Desila se greska: " + textStatus, errorThrown)
    }) 


}

function obrisi(id){

    event.preventDefault();

    request = $.ajax({
        url: "handler/deleteBook.php",
        type: "post",
        data: "knjigaId=" + id
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            alert("Knjiga je obrisana");
            $(`#${id}`).remove()
        } else {
            alert("Knjiga nije obrisana")
        }
    })

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Desila se greska: " + textStatus, errorThrown)
    }) 

}