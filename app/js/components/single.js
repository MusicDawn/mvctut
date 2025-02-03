export function single(users) {
    return `<tr>
    <td>${users.first_name}</td>
    <td>${users.last_name}</td>
    <td>${users.email}</td>
    <td><a id="listButton" class="myButton">List</a></td>
    </tr>`
}