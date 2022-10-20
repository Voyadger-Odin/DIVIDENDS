@extends('layout.main_layout')

@section('page_info')

@endsection



@section('title')
    Аккаунт
@endsection



<!---------- HEAD ---------->
@section('head')

    <link rel="stylesheet" type="text/css" href="{{ URL::to('dividends/resources/css/account/account.css') }}">

@endsection
<!-------------------------->

@section('body')

    <br><br><br><br><br>

    <div class="container">
        <div class="bg-white shadow rounded-lg d-block d-sm-flex ">
            <div class="profile-tab-nav border-right menu-tabs">
                <div class="p-4">
                    <div class="text-center mb-3">
                        <img class="profil-img"
                             src="https://sun2.userapi.com/sun2-10/s/v1/ig2/jqYvwJCEcWO_FfkYlLDeKiSLjZnbUV37eVuRPD92Bert6zRf6H_3FyIXFbY21YQsZ62hIIZ1-F24CS-gCQpPyTFF.jpg?size=200x200&quality=95&crop=148,0,1704,1707&ava=1"
                             alt="Image">
                    </div>
                    <h4 class="text-center">Кучеренко Алексей</h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab"
                       aria-controls="account" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Аккаунт
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                       aria-controls="password" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        Пароль
                    </a>
                    <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                       aria-controls="security" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-piggy-bank-fill" viewBox="0 0 16 16">
                            <path
                                d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595Zm7.173 3.876a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199Zm-8.999-.65a.5.5 0 1 1-.276-.96A7.613 7.613 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.602 6.602 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                        Тариф
                    </a>
                    <a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab"
                       aria-controls="application" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-display" viewBox="0 0 16 16">
                            <path
                                d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z"/>
                        </svg>
                        Приложение
                    </a>
                    <a class="nav-link active show" id="notification-tab" data-toggle="pill" href="#notification"
                       role="tab" aria-controls="notification" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg>
                        Уведомления
                    </a>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="mb-4">Account Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="Kiran">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="Acharya">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="kiranacharya287@gmail.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" class="form-control" value="+91 9876543215">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" class="form-control" value="Kiran Workspace">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" value="UI Developer">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" rows="4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore vero enim error similique quia numquam ullam corporis officia odio repellendus aperiam consequatur laudantium porro voluptatibus, itaque laboriosam veritatis voluptatum distinctio!</textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <h3 class="mb-4">Password Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <h3 class="mb-4">Security Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Two-factor auth</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="recovery">
                                    <label class="form-check-label" for="recovery">
                                        Recovery
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                    <h3 class="mb-4">Application Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="app-check">
                                    <label class="form-check-label" for="app-check">
                                        App check
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Lorem ipsum dolor sit.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade active show" id="notification" role="tabpanel"
                     aria-labelledby="notification-tab">
                    <h3 class="mb-4">Notification Settings</h3>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification1">
                            <label class="form-check-label" for="notification1">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus,
                                neque cupiditate quis
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification2">
                            <label class="form-check-label" for="notification2">
                                hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification3">
                            <label class="form-check-label" for="notification3">
                                commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                            </label>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br>

@endsection
