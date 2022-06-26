function validate(fm) {
  let allow = 0;
  allow += isEmptyFields(fm.username, "erruname");
  allow += checkBoxcheck(fm.acsses, "erracsses");
  allow += isEmptyFields(fm.password, "errpass");
  allow += isEmptyFields(fm.confirm, "errCpass");
  allow += matchPassword(fm.password, fm.confirm);
  return allow === 5 ? true : false;
}

function checkBoxcheck(c, attr) {
  if (c[0].checked !== true && c[1].checked !== true) {
    document.getElementById(attr).hidden = false;
    return 0;
  }
  document.getElementById(attr).hidden = true;
  return 1;
}
function matchPassword(pass, cf_pass) {
  if (!(pass.value === cf_pass.value)) {
    document.getElementById("errMatch").innerHTML =
      "the password is not match!!";
    document.getElementById("errMatch").hidden = false;
    return 0;
  }
  if (pass.value.length < 8) {
    document.getElementById("errMatch").innerHTML =
      "The length of password cannot be less than 8!!";
    document.getElementById("errMatch").hidden = false;
    return 0;
  }
  document.getElementById("errMatch").hidden = true;
  return 1;
}
function isEmptyFields(e, attr) {
  if (e.value === "") {
    document.getElementById(attr).hidden = false;
    return 0;
  }
  document.getElementById(attr).hidden = true;
  return 1;
}
