<?php

function debug($tableau)
{
    echo '<pre>';
    print_r($tableau);
    echo '</pre>';
}

function clean($string)
{
    return trim(strip_tags($string));
}


function textWalid($err, $value, $key, $min, $max, $empty = true)
{
    if (!empty($value)) {
        if (mb_strlen($value) < $min) {
            $err[$key] = 'Min ' . $min . ' caracteres';
        } elseif (mb_strlen($value) > $max) {
            $err[$key] = 'Max ' . $max . ' caracteres';
        }
    } else {
        if ($empty) {
            $err[$key] = 'Veuillez renseigner ce champ';
        }
    }
    return $err;
}

function emailValidation($err, $mail, $key)
{
    if (!empty($mail)) {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $err[$key] = 'Email non valide';
        }
    } else {
        $err[$key] = 'Veuillez renseigner ce champ';
    }
    return $err;
}

function isLogged()
{
    $roles = array('users', 'admin');
    if (!empty ($_SESSION['login'])) {
        if (!empty($_SESSION['login']['id']) && filter_var($_SESSION['login']['id'], FILTER_VALIDATE_INT)) {
            if (!empty($_SESSION['login']['pseudo']) && is_string($_SESSION['login']['pseudo'])) {
                if (!empty($_SESSION['login']['role']) && is_string($_SESSION['login']['role'])) {
                    if (in_array($_SESSION['login']['role'], $roles)) {
                        if (!empty($_SESSION['login']['ip']) && $_SERVER['REMOTE_ADDR'] == $_SESSION['login']['ip']) {
                            return true;
                        }
                    }
                }
            }
        }
    }
    return false;
}

function idAdmin()
{
    if (isLogged()) {
        if (!empty($_SESSION['login']['role'] === 'admin')) {
            return true;
        }
    }
    return false;
}

function verifyMail(string $mail, array $tableauMails): bool
{
    $domaine = explode('@', $mail);
    $domaine = $domaine[1];

    if (in_array($domaine, $tableauMails))
        return true;
    else
        return false;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function paginationIdea($page,$num,$count) {
    echo '<div class="pagination">';
    if ($page > 1){
        echo '<a href="pendu.php?page=' . ($page - 1) . '" class="btn btn-primary">Précédent</a>';
    }

    //n'affiche le lien vers la page suivante que s'il y en a un
    //basée sur le count() de MYSQL
    if ($page*$num < $count) {
        echo '<a href="pendu.php?page=' . ($page + 1) . '" class="btn btn-primary">Suivant</a>';
    }

    echo '</div>';
}
function paginationIdeaManageFilm($page,$num,$count) {
    echo '<div class="pagination">';
    if ($page > 1){
        echo '<a href="manageFilm.php?page=' . ($page - 1) . '" class="btn btn-primary">Précédent</a>';
    }

    //n'affiche le lien vers la page suivante que s'il y en a un
    //basée sur le count() de MYSQL
    if ($page*$num < $count) {
        echo '<a href="manageFilm.php?page=' . ($page + 1) . '" class="btn btn-primary">Suivant</a>';
    }

    echo '</div>';
}
function paginationIdeaSeefilm($page,$num,$count) {
    echo '<div class="pagination">';
    if ($page > 1){
        echo '<a href="seeFilmAdmin.php?page=' . ($page - 1) . '" class="btn btn-primary">Précédent</a>';
    }

    //n'affiche le lien vers la page suivante que s'il y en a un
    //basée sur le count() de MYSQL
    if ($page*$num < $count) {
        echo '<a href="seeFilmAdmin.php?page=' . ($page + 1) . '" class="btn btn-primary">Suivant</a>';
    }

    echo '</div>';
}

