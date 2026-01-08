@extends('layout')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #2d7a6e 0%, #3d9b8c 100%); display: flex; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); max-width: 440px; width: 100%; padding: 48px 40px;">
        
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2d7a6e 0%, #3d9b8c 100%); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; color: white; font-size: 36px; font-weight: 600; box-shadow: 0 8px 16px rgba(45, 122, 110, 0.3);">
                S
            </div>
            <h2 style="margin: 0 0 8px 0; font-size: 28px; color: #1a1a1a; font-weight: 600;">Welcome Back</h2>
            <p style="margin: 0; color: #666; font-size: 14px;">Login to your account</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email Input -->
            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; color: #333; font-size: 14px; font-weight: 500;">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                    style="width: 100%; padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; box-sizing: border-box; outline: none;"
                    onfocus="this.style.borderColor='#3d9b8c'; this.style.boxShadow='0 0 0 3px rgba(61, 155, 140, 0.1)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                >
            </div>

            <!-- Password Input -->
            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; color: #333; font-size: 14px; font-weight: 500;">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Enter your password"
                    required
                    style="width: 100%; padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; box-sizing: border-box; outline: none;"
                    onfocus="this.style.borderColor='#3d9b8c'; this.style.boxShadow='0 0 0 3px rgba(61, 155, 140, 0.1)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                >
            </div>

            <!-- Error Message -->
            @error('email')
                <div style="background: #fee; border-left: 4px solid #e53e3e; padding: 12px 16px; border-radius: 6px; margin-bottom: 24px;">
                    <p style="margin: 0; color: #c53030; font-size: 14px;">{{ $message }}</p>
                </div>
            @enderror

            <!-- Submit Button -->
            <button 
                type="submit"
                style="width: 100%; padding: 14px; background: linear-gradient(135deg, #2d7a6e 0%, #3d9b8c 100%); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(45, 122, 110, 0.3);"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(45, 122, 110, 0.4)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(45, 122, 110, 0.3)'"
            >
                Login
            </button>
        </form>

        <!-- Footer -->
        <div style="margin-top: 32px; text-align: center;">
            <p style="margin: 0; color: #999; font-size: 13px;">
                Don't have an account? 
                <a href="#" style="color: #3d9b8c; text-decoration: none; font-weight: 600;">Sign up</a>
            </p>
        </div>
    </div>
</div>
@endsection