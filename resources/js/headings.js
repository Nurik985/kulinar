// function delayTimer(callback, ms) {
//     let timer = 0;
//     return function () {
//         const context = this,
//             args = arguments;
//         clearTimeout(timer);
//         timer = setTimeout(function () {
//             callback.apply(context, args);
//         }, ms || 0);
//     };
// }
//
// $(document).on("keyup", ".findRub", delayTimer(function (e) {
//     const search = $(this).val();
//     const parent = $(this).parent().parent();
//     $.ajax({
//         type: "POST",
//         url: "/admin/get-rubrics",
//         data: {search: search, '_token': window.csrf},
//     }).done(function (data) {
//         $(parent).find("ul").html(data);
//         if(data){
//             $(parent).find(".abs-items").show();
//         }
//         $(parent).find(".line-val div").each(function () {
//             const text = $(this).find("span").text();
//             $(parent).find("li").each(function () {
//                 const text2 = $(this).text();
//                 if (text2 == text) {
//                     $(this).css({display: "none"});
//                 }
//             });
//         });
//     });
//     return false;
// }, 300));
//
// $(document).on("keyup", ".findSec", delayTimer(function (e) {
//     const search = $(this).val();
//     const parent = $(this).parent().parent();
//     $.ajax({
//         type: "POST",
//         url: "/admin/get-sections",
//         data: {search: search, '_token': window.csrf},
//     }).done(function (data) {
//         $(parent).find("ul").html(data);
//         if(data){
//             $(parent).find(".abs-items").show();
//         }
//         $(parent).find(".line-val div").each(function () {
//             const text = $(this).find("span").text();
//             $(parent).find("li").each(function () {
//                 const text2 = $(this).text();
//                 if (text2 == text) {
//                     $(this).css({display: "none"});
//                 }
//             });
//         });
//     });
//     return false;
// }, 300));
//
// $(document).on("click", ".abs-items li", function () {
//     const parent = $(this).parent();
//     if ($(this).attr("id") > 0) {
//         const id = $(this).attr("id");
//         const text = $(this).text();
//         const parent = $(this).parent().parent().parent().parent();
//         $(parent).find(".div-block-item").append('<div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex"><span id="' + id + '">' + text + "</span><i class=\"ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600\"></i></div></div>",);
//     } else if ($(parent).hasClass("cl") == true) {
//         const text = $(this).text();
//         const parent = $(this).parent().parent().parent().parent();
//         $(parent).find(".inpt_text").before('<div class="item mrg-item"><span>' + text + "</span><strong>х</strong></div>");
//     } else {
//         const text = $(this).text();
//         const parent = $(this).parent().parent().parent().parent();
//         if ($(parent).find(".check-logic").prop("checked")) {
//             $(parent)
//                 .find(".inpt_text")
//                 .before(
//                     '<div class="block_item"><div class="div_usl">или</div><div class="item"><span>' +
//                     text +
//                     "</span><strong>х</strong></div></div>",
//                 );
//         } else {
//             $(parent)
//                 .find(".inpt_text")
//                 .before(
//                     '<div class="block_item"><div class="div_usl">и</div><div class="item"><span>' +
//                     text +
//                     "</span><strong>х</strong></div></div>",
//                 );
//         }
//     }
//
//     $(parent).parent().parent().parent().find(".inpt_text").val("");
//     $(".abs-items").slideUp(200);
// });
//
// $(document).on("click", ".removeItem", function () {
//     const parent = $(this).parent().parent().remove();
// });
//
// $(document).mouseup(function (e) {
//     const block = $(".div_mass");
//     if (!block.is(e.target) && block.has(e.target).length === 0) {
//         $(".abs-items").slideUp(200);
//     }
// });
