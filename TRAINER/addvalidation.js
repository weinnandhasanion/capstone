
 //Validation
 validateEmail = (email) => {
    let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  
  checkEmail = (e) => {
    let empty = document.getElementById(`${e.id}-empty`);
    let invalid = document.getElementById(`${e.id}-invalid`);
  
    if(e.value == '') {
      empty.style.display = 'block';
      invalid.style.display = 'none';
    } else {
      empty.style.display = 'none';
  
      if(!validateEmail(e.value)) {
        invalid.style.display = 'block';
      } else {
        invalid.style.display = 'none';
      }
    }
  }
  
  checkIfValid = (e) => {
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
  
  
  checkGender = (e) => {
    let empty = document.getElementById(`${e.id}-invalid`);
    
    if(e.value == '') {
      empty.style.display = 'block';
    } else {
      empty.style.display = 'none';
    }
  
  }

  checkSchedule = (e) => {
    let empty = document.getElementById(`${e.id}-invalid`);
    
    if(e.value == '') {
      empty.style.display = 'block';
    } else {
      empty.style.display = 'none';
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
      } else if(e.value.length != 11) {
        length.style.display = 'block';
        valid = false;
      } else {
        length.style.display = 'none';
      }
    }
  }
  
  checkDate = (e) => {
    let invalid = document.getElementById(`${e.id}-invalid`);
    let underage = document.getElementById(`${e.id}-underage`)
    if(e.value == '') {
      invalid.style.display = 'block';
      underage.style.display = 'none';
    } else {
      let date = new Date(e.value);
      if(date.getFullYear() >= new Date().getFullYear()) {
        invalid.style.display = 'block';
        underage.style.display = 'none';
      } else {
        if(date.getFullYear() > new Date().getFullYear() - 18) {
          invalid.style.display = 'none';
          underage.style.display = 'block';
        } else if(date.getFullYear() < new Date('1920-01-01').getFullYear()) {
          invalid.style.display = 'block';
          underage.style.display = 'none';
        } else {
          invalid.style.display = 'none';
          underage.style.display = 'none';
        }
      }
    }
  }
  
  checkValidityAll = () => {
  
    // email
    let email = document.getElementById('email');
    let emptyEmail = document.getElementById(`email-empty`);
    let invalidEmail = document.getElementById(`email-invalid`);
    let emailValid;
    if(email.value == '') {
      emptyEmail.style.display = 'block';
      invalidEmail.style.display = 'none';
      emailValid = false;
    } else {
      emptyEmail.style.display = 'none';
  
      if(!validateEmail(email.value)) {
        invalidEmail.style.display = 'block';
        emailValid = false;
      } else {
        invalidEmail.style.display = 'none';
        emailValid = true;
      }
    }
  
     // fname
     let fname = document.getElementById('fname');
     let fnameValid;
     if(fname.value == '') {
       document.getElementById(`fname-empty`).style.display = 'block';
       fnameValid = false;
     } else {
       document.getElementById(`fname-empty`).style.display = 'none';
       if(parseInt(fname.value) || fname.value.match(/\d+/) != null) {
         document.getElementById(`fname-invalid`).style.display = 'block';
         fnameValid = false;
       } else {
         document.getElementById(`fname-invalid`).style.display = 'none';
         fnameValid = true;
       }
     }
  
     // gender
     let sex = document.getElementById('sex');
     let sexValid;
     if(sex.value == '') {
       document.getElementById(`sex-invalid`).style.display = 'block';
       sexValid = false;
     } else {
       document.getElementById(`sex-invalid`).style.display = 'none';
       
     }
    
     // schedule
     let schedule = document.getElementById('schedule');
     let scheduleValid;
     if(schedule.value == '') {
       document.getElementById(`schedule-invalid`).style.display = 'block';
       sexValid = false;
     } else {
       document.getElementById(`schedule-invalid`).style.display = 'none';
       
     }
      // lname
    let lname = document.getElementById('lname');
    let lnameValid;
    if(lname.value == '') {
      document.getElementById(`lname-empty`).style.display = 'block';
      lnameValid = false;
    } else {
      document.getElementById(`lname-empty`).style.display = 'none';
      if(parseInt(lname.value) || lname.value.match(/\d+/) != null) {
        document.getElementById(`lname-invalid`).style.display = 'block';
        lnameValid = false;
      } else {
        document.getElementById(`lname-invalid`).style.display = 'none';
        lnameValid = true;
      }
    }
  
  
    // phone
    let phone = document.getElementById('phone');
    let phoneEmpty = document.getElementById(`phone-empty`);
    let phoneInvalid = document.getElementById(`phone-invalid`);
    let length = document.getElementById(`phone-length`);
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
  
  
      // birthdate
      let birthdate = document.getElementById('birthdate');
      let invalid = document.getElementById(`birthdate-invalid`);
      let underage = document.getElementById(`birthdate-underage`);
      let birthdateValid;
      if(birthdate.value == '') {
        invalid.style.display = 'block';
        underage.style.display = 'none';
        birthdateValid = false;
      } else {
        let date = new Date(birthdate.value);
        if(date.getFullYear() >= new Date().getFullYear()) {
          invalid.style.display = 'block';
          underage.style.display = 'none';
          birthdateValid = false;
        } else {
          if(date.getFullYear() > new Date().getFullYear() - 12) {
            invalid.style.display = 'none';
            underage.style.display = 'block';
            birthdateValid = false;
          } else if(date.getFullYear() < new Date('1920-01-01').getFullYear()) {
            invalid.style.display = 'block';
            underage.style.display = 'none';
            birthdateValid = false;
          } else {
            invalid.style.display = 'none';
            underage.style.display = 'none';
            birthdateValid = true;
          }
        }
      }
    
      // address
    let address = document.getElementById('address');
    let addressEmpty = document.getElementById('address-empty');
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
  
  }