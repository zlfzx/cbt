(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../../store */ "./resources/js/store/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'Beranda',
  data: function data() {
    return {
      headers: [{
        text: 'Nama Ujian',
        align: 'center'
      }, {
        text: 'Mata Pelajaran',
        align: 'center'
      }, {
        text: 'Waktu',
        align: 'center'
      }, {
        text: 'Jumlah Soal',
        align: 'center'
      }, {
        text: 'Status',
        align: 'center'
      }]
    };
  },
  computed: {
    token: function token() {
      return _store__WEBPACK_IMPORTED_MODULE_0__["default"].state.auth.token;
    },
    check_password: function check_password() {
      return _store__WEBPACK_IMPORTED_MODULE_0__["default"].state.check_password;
    }
  },
  mounted: function mounted() {
    console.log('beranda');
    axios__WEBPACK_IMPORTED_MODULE_1___default.a.get('/api/password/check', {
      headers: {
        Authorization: "Bearer " + this.token,
        'Content-Type': 'application/json'
      }
    }).then(function (response) {
      var res = response.data;
      _store__WEBPACK_IMPORTED_MODULE_0__["default"].commit("SET_CHECK_PASSWORD", res.status); // console.log(res)
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570& ***!
  \**********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-row",
    [
      _c(
        "v-col",
        { attrs: { cols: "12", sm: "12", md: "8" } },
        [
          _vm.check_password
            ? _c(
                "v-alert",
                { attrs: { prominent: "", type: "error" } },
                [
                  _c(
                    "v-row",
                    { attrs: { align: "center" } },
                    [
                      _c("v-col", { staticClass: "grow" }, [
                        _vm._v(
                          "Sebelum memulai ujian harap mengganti kata sandi terlebih dahulu."
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-col",
                        { staticClass: "shrink" },
                        [
                          _c("v-btn", { attrs: { to: "pengaturan" } }, [
                            _vm._v("Ganti Kata Sandi")
                          ])
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            : _c(
                "v-card",
                [
                  _c(
                    "v-toolbar",
                    { attrs: { dense: "", flat: "", color: "blue", dark: "" } },
                    [_c("v-toolbar-title", [_vm._v("Daftar Ujian")])],
                    1
                  ),
                  _vm._v(" "),
                  _c("v-data-table", { attrs: { headers: _vm.headers } })
                ],
                1
              )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/Home/Beranda.vue":
/*!*********************************************!*\
  !*** ./resources/js/views/Home/Beranda.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Beranda.vue?vue&type=template&id=3535f570& */ "./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570&");
/* harmony import */ var _Beranda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Beranda.vue?vue&type=script&lang=js& */ "./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Beranda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Home/Beranda.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Beranda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Beranda.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Home/Beranda.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Beranda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570&":
/*!****************************************************************************!*\
  !*** ./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Beranda.vue?vue&type=template&id=3535f570& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Home/Beranda.vue?vue&type=template&id=3535f570&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Beranda_vue_vue_type_template_id_3535f570___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);