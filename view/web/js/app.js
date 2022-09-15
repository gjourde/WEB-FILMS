let containerRoles = document.getElementById('containerRoles');
let btnAjout = document.getElementById('btnAjout');
let nbRole = document.getElementById('nbRole');

function creerRole() {
    let ajoutRole = document.createElement('button');
    ajoutRole.className = 'btn btn-primary mx-3';
    ajoutRole.textContent = 'Ajouter un role';
    ajoutRole.addEventListener('click', (e) => {
        e.preventDefault();
        creerRole();
    });
    let sautLigne = document.createElement('br');
    let hr = document.createElement('hr');
    let saisiePersonnage = document.createElement('input');
    saisiePersonnage.type = 'text'
    saisiePersonnage.required = 'true'
    saisiePersonnage.name = 'saisiePersonnage' + index;
    saisiePersonnage.className = 'mx-2';
    saisiePersonnage.placeholder = ' Saisir Personnage';
    let saisieNom = document.createElement('input');
    saisieNom.type = 'text';
    saisieNom.required = 'true'
    saisieNom.name = 'saisieNom' + index;
    saisieNom.className = 'mx-2';
    saisieNom.placeholder = ' Saisir Nom acteur';
    let saisiePrenom = document.createElement('input');
    saisiePrenom.type = 'text';
    saisiePrenom.required = 'true'
    saisiePrenom.name = 'saisiePrenom' + index;
    saisiePrenom.className = 'mx-2';
    saisiePrenom.placeholder = ' Saisir Prenom acteur';
    containerRoles.append(saisiePersonnage, saisieNom, saisiePrenom, ajoutRole, sautLigne, hr);

    index++
}

btnAjout.addEventListener('click', () => {
    nbRole.value = index;
})

let index = 1;
creerRole();