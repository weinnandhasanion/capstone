checkIfValid2 = (e) => {
    let empty = document.getElementById(`${e.id}-empty`);
    if(e.id != 'address') {
      let invalid = document.getElementById(`${e.id}-invalid`);
  
      if(e.value == '') {
        empty.style.display = 'block';
      } else {
        empty.style.display = 'none';
      }
  
      if(parseInt(e.value) || e.value.match(/\d+/) != null) {
        invalid.style.display = 'block';
      } else {
        invalid.style.display = 'none';
      }
    } else {
      if(e.value == '') {
        empty.style.display = 'block';
      } else {
        empty.style.display = 'none';
      }
    }
  }

  checkNumber2 = (e) => {
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
      } else if(e.value.length != 11) {
        length.style.display = 'block';
        valid = false;
      } else {
        length.style.display = 'none';
      }
    }
  }
  
  
  checkValidityAll2 = () => {
// address
let address = document.getElementById('update_address');
let addressEmpty = document.getElementById('update_address-empty');
let addressValid;
if(address.value == '') {
  addressEmpty.style.display = 'block';
  addressValid = false;
} else {
  addressEmpty.style.display = 'none';
  addressValid = true;
}


if(fnameValid == true 
  && lnameValid == true
  && birthdateValid == true
  && emailValid == true
  && addressValid == true
  && phoneValid == true) {
  return true;
}

// phone
let phone = document.getElementById('update_phone');
let phoneEmpty = document.getElementById(`update_phone-empty`);
let phoneInvalid = document.getElementById(`update_phone-invalid`);
let length = document.getElementById(`update_phone-length`);
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
    } else if(phone.value.length != 11) {
      length.style.display = 'block';
      phoneValid = false;
    } else {
      length.style.display = 'none';
      phoneValid = true;
    }
  }
}

  }