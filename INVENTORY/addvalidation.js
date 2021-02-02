
  
//validation//validation//validation//validation//validation//validation//validation//validation//validation

checkValidityAll = () => {
    // name
 let fname = document.getElementById('name');
 let fnameValid;
 if(fname.value == '') {
   document.getElementById(`name-empty`).style.display = 'block';
   fnameValid = false;
 } else {
   document.getElementById(`name-empty`).style.display = 'none';
   if(parseInt(fname.value) || fname.value.match(/\d+/) != null) {
     document.getElementById(`name-invalid`).style.display = 'block';
     fnameValid = false;
   } else {
     document.getElementById(`name-invalid`).style.display = 'none';
     fnameValid = true;
   }
 }


  // quantity
let phone = document.getElementById('quantity');
let phoneEmpty = document.getElementById(`quantity-empty`);
let phoneInvalid = document.getElementById(`quantity-invalid`);
let length = document.getElementById(`quantity-length`);
let phoneValid;
if(phone.value == '') {
  phoneEmpty.style.display = 'block';
  length.style.display = 'none';
  phoneValid = false;
} else {
  phoneEmpty.style.display = 'none';
  if(phone.value.match(/[a-zA-Z]/) != null) {
    phoneInvalid.style.display = 'block';
    length.style.display = 'none';
    phoneValid = false;
  } else {
    phoneInvalid.style.display = 'none';
    if(phoneEmpty.style.display == 'block' || phoneInvalid.style.display == 'block') {
      length.style.display = 'none';
    } else if(phone.value.length > 3) {
      length.style.display = 'block';
      phoneValid = false;
    } else {
      length.style.display = 'none';
      phoneValid = true;
    }
  }
}

// Category
let category = document.getElementById('category');
let categoryValid;
if(category.value == '') {
  document.getElementById(`category-invalid`).style.display = 'block';
  categoryValid = false;
} else {
  document.getElementById(`category-invalid`).style.display = 'none';
  
}


// description
let description = document.getElementById('description');
let descriptionValid;
if(description.value == '') {
  document.getElementById(`description-invalid`).style.display = 'block';
  descriptionValid = false;
} else {
  document.getElementById(`description-invalid`).style.display = 'none';
  
}



 if(fnameValid == true 
 && phoneValid == true) {
  return true;
}

}

checkCategory = (e) => {
  let empty = document.getElementById(`${e.id}-invalid`);
  
  if(e.value == '') {
    empty.style.display = 'block';
  } else {
    empty.style.display = 'none';
  }

}

checkDescription = (e) => {
  let empty = document.getElementById(`${e.id}-invalid`);
  
  if(e.value == '') {
    empty.style.display = 'block';
  } else {
    empty.style.display = 'none';
  }

}


checkIfValid = (e) => {
let empty = document.getElementById(`${e.id}-empty`);


  if(e.value == '') {
    empty.style.display = 'block';
  } else {
    empty.style.display = 'none';
    invalid.style.display = 'none';
  }

}

checkNumber = (e) => {
let empty = document.getElementById(`${e.id}-empty`);
let invalid = document.getElementById(`${e.id}-invalid`);
let length = document.getElementById(`${e.id}-length`);
if(e.value == '') {
  empty.style.display = 'block';
  length.style.display = 'none';
} else {
  empty.style.display = 'none';
}

if(e.value.match(/[a-zA-Z]/) != null) {
  invalid.style.display = 'block';
  length.style.display = 'none';
} else {
  invalid.style.display = 'none';
  if(empty.style.display == 'block' || invalid.style.display == 'block') {
    length.style.display = 'none';
  } else if(e.value.length > 3) {
    length.style.display = 'block';
    valid = false;
  } else {
    length.style.display = 'none';
  }
}
}
