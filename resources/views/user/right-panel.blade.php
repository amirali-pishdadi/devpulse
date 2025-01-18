<div class="col-lg-3">
                        <div class="sidebar">
                                                        <ul class="sidebar-list">
                                <li><a class="{{ url()->current() == url('/edit/user/' . Auth::user()->username ) ? 'active' : '' }}" href="/edit/user/{{ Auth::user()->username }}"><i class="far fa-user"></i>
                                        نمایه من</a>
                                </li>
                                <li><a class="{{ url()->current() == url('/setting') ? 'active' : '' }}" href="/setting"><i class="far fa-gear"></i> تنظیمات</a></li>
                                <li><a href="/logout/{{ Auth::user()->username }}"><i class="far fa-sign-out"></i> خروج</a></li>
                            </ul>
                        </div>
                    </div>