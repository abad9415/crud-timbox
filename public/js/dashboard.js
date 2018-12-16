/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__validations_auth__ = __webpack_require__(46);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__validations_auth___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__validations_auth__);


/***/ }),

/***/ 46:
/***/ (function(module, exports) {

$("#registerForm").submit(function () {
    var error = false;
    //Name
    if (!validateName()) error = true;

    //Email
    if (!validateEmail()) error = true;

    //RFC
    if (!validateRFC()) error = true;

    //Company Name
    if (!validateCompanyName()) error = true;

    //Password
    if (!validatePassword()) error = true;

    //Password confirm
    if (!validatePasswordConfirm()) error = true;

    if (error) return false;
});

//Validations functions
function validateName() {
    return validateEmptyInput('#name', '#errorName', 'El nombre no puede ser vacio');
}

function validateEmail() {
    return validateEmptyInput('#email', '#errorEmail', 'El email no puede ser vacio');
}

function validateRFC() {
    var rfc = $("#rfc").val().toUpperCase();
    if (!validateEmptyInput('#rfc', '#errorRfc', 'El RFC no puede ser vacio')) return false;

    //Validate RFC structure Source: https://es.stackoverflow.com/a/31714
    var reg = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
    var validated = rfc.match(reg);
    if (!validated) {
        showInputError("#rfc", "#errorRfc", 'El RFC no es valido');
        return false;
    }

    //Separate the check digit of the entire RFC
    var checkDigit = validated.pop(),
        rfcWithoutDigit = validated.slice(1).join(''),
        len = rfcWithoutDigit.length,


    //Get the expected digit
    dictionary = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
        index = len + 1;
    var sum, expectedDigit;

    if (len == 12) sum = 0;else sum = 481; //Adjustment for moral person

    for (var i = 0; i < len; i++) {
        sum += dictionary.indexOf(rfcWithoutDigit.charAt(i)) * (index - i);
    }expectedDigit = 11 - sum % 11;
    if (expectedDigit == 11) expectedDigit = 0;else if (expectedDigit == 10) expectedDigit = "A";

    //The check digit matches the expected?
    // or is it a Generic RFC (sales to the general public)?
    if (checkDigit != expectedDigit && rfcWithoutDigit + checkDigit != "XAXX010101000") {
        showInputError("#rfc", "#errorRfc", 'El RFC no es valido');
        return false;
    } else if (rfcWithoutDigit + checkDigit == "XEXX010101000") {
        showInputError("#rfc", "#errorRfc", 'El RFC no es valido');
        return false;
    }

    return true;
}

function validateCompanyName() {
    return validateEmptyInput('#company_name', '#errorCompanyName', 'El nombre de la empresa no puede ser vacio');
}

function validatePassword() {
    if (!validateEmptyInput('#password', '#errorPassword', 'La contraseña no puede ser vacia')) return false;

    if ($("#password").val().length < 6) {
        showInputError("#password", "#errorPassword", 'Las contraseña no debe ser menor a 6 caracteres');
        return false;
    }

    return true;
}

function validatePasswordConfirm() {
    if (!validateEmptyInput('#password-confirm', '#errorPasswordConfirm', 'La confirmación de la contraseña no puede ser vacia')) return false;

    if ($("#password-confirm").val() !== $("#password").val()) {
        showInputError("#password-confirm", "#errorPasswordConfirm", 'Las contraseñas no coinciden');
        return false;
    }

    return true;
}

function validateEmptyInput(selector, selectorError, textError) {
    var input = $(selector).val();
    if (!input.replace(/\s/g, '').length) {
        showInputError(selector, selectorError, textError);
        return false;
    }
    return true;
}

function showInputError(selector, selectorError, textError) {
    $(selector).addClass('is-invalid');
    $(selectorError).html(textError);
    watchIfInputIsFilling();
}

function watchIfInputIsFilling() {
    $('.is-invalid').keyup(function () {
        $(this).removeClass('is-invalid');
    });
}

/***/ })

/******/ });