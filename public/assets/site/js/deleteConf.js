$(document).ready(function ($) {

    $("body").on("click", ".delete", function (e) {
            e.stopPropagation();
            if(confirm('Are you sure you want to delete this plant?')) return true;
            return false;            
        });
        
    $("body").on("click", ".deleteAll", function (e) {
            e.stopPropagation();
            if(confirm('If you delete this category, you will also delete all it\'s subcategories and products! Are you sure you want to proceed?')) return true;
            return false;            
        });
     
});
