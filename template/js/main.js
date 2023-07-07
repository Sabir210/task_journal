// /*price range*/
//
// $('#sl2').slider();
//
// var RGBChange = function () {
//     $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
// };
//
// /*scroll to top*/
//
// $(document).ready(function () {
//     $(function () {
//         $.scrollUp({
//             scrollName: 'scrollUp', // Element ID
//             scrollDistance: 300, // Distance from top/bottom before showing element (px)
//             scrollFrom: 'top', // 'top' or 'bottom'
//             scrollSpeed: 300, // Speed back to top (ms)
//             easingType: 'linear', // Scroll to top easing (see http://easings.net/)
//             animation: 'fade', // Fade, slide, none
//             animationSpeed: 200, // Animation in speed (ms)
//             scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
//             //scrollTarget: false, // Set a custom target element for scrolling to the top
//             scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
//             scrollTitle: false, // Set a custom <a> title if required.
//             scrollImg: false, // Set true to use image
//             activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
//             zIndex: 2147483647 // Z-Index for the overlay
//         });
//     });
//
//     $('#myCarousel').carousel({
//         interval: 10000
//     })
//
//     $('.carousel .item').each(function () {
//         var next = $(this).next();
//         if (!next.length) {
//             next = $(this).siblings(':first');
//         }
//         next.children(':first-child').clone().appendTo($(this));
//
//         if (next.next().length > 0) {
//             next.next().children(':first-child').clone().appendTo($(this));
//         }
//         else {
//             $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
//         }
//     });
// });

(function(){
    var app = angular.module("phonebook",[]);
    var appController=function($scope){

        $scope.rowLimit=3;
        $scope.currentPage = 0;
        $scope.numPerPage = 9;


        $scope.info=[
            {name:"Mohamed",phone:'05-020-2356', email:'m.hazem@yahoo.com'},
            {name:'ahmed', phone:'02-030-4986', email:'ah.basem@yahoo.com'},
            {name:'laila', phone:'01-111-2357', email:'laila@gmail.com'},
            {name:'salma', phone:'01-268-1548', email:'salma@gmail.com'},
            {name:'ahmed', phone:'02-030-4986', email:'ah.basem@yahoo.com'},
            {name:'laila', phone:'01-111-2357', email:'laila@gmail.com'},
            {name:'salma', phone:'01-268-1548', email:'salma@gmail.com'},
            {name:'ahmed', phone:'02-030-4986', email:'ah.basem@yahoo.com'},
            {name:'laila', phone:'01-111-2357', email:'laila@gmail.com'},
            {name:'salma', phone:'01-268-1548', email:'salma@gmail.com'},
            {name:'ahmed', phone:'02-030-4986', email:'ah.basem@yahoo.com'},
            {name:'laila', phone:'01-111-2357', email:'laila@gmail.com'},
            {name:'salma', phone:'01-268-1548', email:'salma@gmail.com'}];


        $scope.addContact = function(){
            for(i=0;i<$scope.info.length&&$scope.info.length<10000;i++){

                $scope.info.push({ 'name':$scope.info.newName, 'phone': $scope.newPhone, 'email':$scope.newEmail });
                $scope.newName='';
                $scope.newPhone='';
                $scope.newEmail='';

            }
        };
        $scope.removeContact = function() {
            $scope.info.splice(this.$index, 1);
        };

        $scope.search= function(item){

            if($scope.searchContact==undefined){
                return true;
            }

            else{

                if($scope.searchContact.toLowerCase() && item.name.toLowerCase().indexOf($scope.searchContact.toLowerCase())   != -1||  item.phone && item.phone.indexOf($scope.searchContact)!=-1)
                {
                    return true;
                }
            }

            return false;
        };




    };
    app.controller("appController",appController);
}());
