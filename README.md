# CRESENT: Building Brighter Connections
Cresent is a website that helps people take their first step on building their own professional team. Essentially, it serves as a bridge for individuals who want to start their own company. They can upload their credentials for other people to see then establish a connection to whomever they like. 

## SYSTEM ARCHITECTURE
The database of this system six main tables:
- three parent tables (**Positions**, **Subjects**, and **Teams**);
- one parent && child (Users table is the parent of Connections table and Categories table);
- and two bridge tables (**Connections table** links two users, while **Categories table** is a bridge for the many-to-many relationship of **Users table** and **Subjects table**)

The other tables are provided by Laravel when the tables are migrated

#### Table Relationships
![CresentEntityDiagram](https://drive.google.com/uc?export=download&id=1x_RLr0ulXiwjbcRUBaC0eBYn4fbo2M_O)

#### (Common) Users/Clients can perform the following function:
- Register and Login
- Update Profile (includes upload of image and pdf of CV)
- View and/or download the CVs uploaded by the users (including their own)
- Send and receive connection request from other users
- Confirm and decline the received requests
- Delete requests sent to other users
- Create a team
- Add members to the team
- Update the team info and members
- Delete team
- View other teams

#### Admin, on the other hand, can:
- View the number of users, positions, subjects, and teams registered on the website
- View the number of members per team (including those who do not have a team yet)
- Edit the name of positions
- Edit the name of Subjects
- View the users' name and email
- Delete a user

## FRAMEWORK
This web application is built using Laravel v.7 integrated with Bootsrap v.4.6. 

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
