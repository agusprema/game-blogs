<?php

function getCategory($id){
    return Repository\Category::findCategoryByPostIdToPost($id);
}