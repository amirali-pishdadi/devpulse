<?php

namespace App\Http\Controllers;

use App\Helper\EmailSender;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        try {
            $formFields = $request->validate([
                "email" => "required|email|min:3|unique:users,email",
                "code"  => "required|string|size:6",
            ]);

            $code = $formFields["code"];
            $email = $formFields["email"];

            $emailBody = view('email.verification-code', [
                "email" => $email,
                "code"  => $code,
                "date"  => now(),
            ])->render();

            $emailSent = EmailSender::sendEmail("amirpishdadi4@gmail.com", 'Verification Code', $emailBody);

            if ($emailSent) {
                return response()->json([
                    'success' => true,
                    'message' => 'کد تایید با موفقیت ارسال شد.',
                ]);
            } else {
                throw new \Exception('Email sending failed');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات وارد شده معتبر نیست.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in sendVerificationCode: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'خطایی رخ داده است. لطفا دوباره تلاش کنید.',
            ], 500);
        }
    }


    public function searchPage(Request $request)
    {
        $ArticleQuery = Article::query();
        $CategoryQuery = Category::query();
        $TagQuery = Tag::query();

        // Apply the search filter if present
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $ArticleQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchTerm . '%');
            });

            $CategoryQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchTerm . '%');
            });

            $TagQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('title', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Execute the query and get the filtered products
        $articles = $ArticleQuery->get();
        $categories = $CategoryQuery->get();
        $tags = $TagQuery->get();

        return view('search', ['articles' => $articles, 'categories' => $categories, 'tags' => $tags, "searchTerm" => $searchTerm]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("auth.sign-up");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "name"     => ["required", "string", "min:3"],
            "email"    => ["required", "email", "min:3"],
            "username" => ["required", "string", "min:8"],
            "password" => ["required", "string", "min:8", "confirmed"],
        ]);



        $user = User::create([
            "name"     => $formFields["name"],
            "username" => $formFields["username"],
            "email"    => $formFields["email"],
            "password" => Hash::make($formFields["password"]),
            "is_admin" => false,
        ]);
        $token = $user->createToken("auth_token_" . $user->email)->plainTextToken;

        return redirect("/login")->with("message", "ثبت نام با موفقیت انجام شد. اکنون می توانید وارد شوید.");

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }


    public function login()
    {
        return view("auth.login");
    }


    public function authenthicate(Request $request)
    {
        $formFields = $request->validate([
            'email'    => 'email|required|min:3',
            'password' => 'string|required|min:8',
        ]);

        if (Auth::attempt($formFields)) {
            $user = User::where('email', $formFields["email"])->first();
            auth()->login($user);
            return redirect("/");
        } else {
            return redirect('/login')->with("message" , "اطلاعات وارد شده معتبر نیست.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return view("user.edit", ["user" => $user]);
    }
    public function deleteAccount()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect('/')
            ->with('message', 'حساب کاربری شما با موفقیت حذف گردید.');
    }
    public function setting()
    {

        return view("user.setting");
    }
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'رمز عبور با موفقیت تغییر یافت.');
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'description' => 'string',
        ]);

        // Update user fields
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->description = $validated["description"];


        // Save the changes
        $user->save();

        // Redirect or return a response
        return redirect("/edit/user/$user->username")->with('message', 'اطلاعات کاربر با موفقیت به‌روزرسانی شد.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function logout(string $username)
    {
        $user = User::where('username', $username)->first();

        if ($user == Auth::user()) {

            Auth::logout();

            return back()->with("message", "شما با موفقیت خارج شدید");
        } else {
            abort(404);
        }
    }
}
