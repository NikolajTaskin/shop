<?php
/**
 *
 * Checks if user(data) already exists in our saved file.
 *
 * If there is no such data(user) returns true.
 * If the data already exist in file, writes an error and returns false.
 *
 * @param string $field_input - clean input value
 * @param array $field - input array
 * @return bool
 */
function validate_user_unique(string $field_input, array &$field): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', ['email' => $field_input])) {
        $field['error'] = 'Toks vartotojas jau egzistuoja';

        return false;
    }

    return true;
}

/**
 *
 *Checks if there is such email and password in the database.
 *
 * If there is such user and password is the same as in database returns true.
 * If email or password of $filtered_input are not in the database(or not the same),
 * writes an error and returns false.
 *
 * @param array $filtered_input - clean inputs array with values
 * @param array $form - form array
 * @return bool
 */
function validate_login(array $filtered_input, array &$form): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', [
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ])) {
        return true;
    }

    $form['error'] = 'Suvesti neteisingi duomenys';

    return false;
}

/**
 * Checks if wanted block position is alrady filled
 *
 * @param array $form_input
 * @param array $form
 * @return bool
 */
function validate_tetris_unique(array $form_input, array &$form): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('items', [
        'X' => $form_input['X'],
        'Y' => $form_input['Y']
    ])) {
        $form['error'] = 'Ši bloko vieta jau užimta';

        return false;
    }

    return true;
}