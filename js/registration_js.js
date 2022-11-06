let inputs = document.querySelectorAll('input');

let errors = {
	"korisnicko_ime": [],
	"ime": [],
	"prezime": [],
	"email": [],
	"lozinka": [],
	"ponovi_lozinku": []
};

inputs.forEach((element) => {
	element.addEventListener('change', e => {

		let currentInput = e.target;
		let inputValue = currentInput.value;
		let inputName = currentInput.getAttribute('name');

		if(inputValue.length > 2){

			errors[inputName] = [];

			switch(inputName){
				
				case 'email': 
					if(!validateEmail(inputValue))
						errors[inputName].push('Neispravan email');
					break;

				case 'ponovi_lozinku': 
					let pass = document.querySelector('input[name = "lozinka"]').value;
					if(inputValue !== pass)
						errors[inputName].push('Lozinke se ne poklapaju');
					break;
			}

		}else {
			errors[inputName] = ['Polje ne moze imati manje od 2 karaktera'];

		}

		populateErrors();

	});
});


const populateErrors = () => {

	for(let elem of document.querySelectorAll('ul'))
		elem.remove();

	for(let key of Object.keys(errors)){

		let input = document.querySelector(`input[name = "${key}"]`);
		let parentElement = input.parentElement;
		let errorsElement = document.createElement('ul');
		parentElement.appendChild(errorsElement);

		errors[key].forEach(error => {
			let li = document.createElement('li');
			li.innerText = error;
			errorsElement.appendChild(li);
		})

	}

}


const validateEmail = email => {

	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
		return true;
	
	return false;

}




