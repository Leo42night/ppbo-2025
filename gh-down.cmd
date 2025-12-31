@echo off
setlocal enabledelayedexpansion

REM === Parameter check ===
if "%~2"=="" (
    echo Usage:
    echo   gh-down [output_name] [github_url]
    exit /b
)

set "OUTNAME=%~1"
set "URL=%~2"

REM === Deteksi file vs folder ===
echo %URL% | find "/blob/" >nul
if %errorlevel%==0 (
    set "MODE=file"
) else (
    set "MODE=folder"
)

REM === Bersihkan file sementara ===
if exist __gh_tmp__.py del /f /q __gh_tmp__.py
if exist gh_tmp_folder rmdir /s /q gh_tmp_folder 2>nul

REM === Tulis Python script sementara ===
echo import os, requests, shutil, json > __gh_tmp__.py
echo url = "%URL%" >> __gh_tmp__.py
echo outname = "%OUTNAME%" >> __gh_tmp__.py
echo mode = "%MODE%" >> __gh_tmp__.py
echo print(f"[INFO] MODE: {mode}") >> __gh_tmp__.py

REM ========== FILE MODE ==========
echo if mode == "file": >> __gh_tmp__.py
echo.    parts = url.split("/blob/") >> __gh_tmp__.py
echo.    repo = parts[0].replace("https://github.com/", "") >> __gh_tmp__.py
echo.    branch = parts[1].split("/")[0] >> __gh_tmp__.py
echo.    path = "/".join(parts[1].split("/")[1:]) >> __gh_tmp__.py
echo.    raw = f"https://raw.githubusercontent.com/{repo}/{branch}/{path}" >> __gh_tmp__.py
echo.    print(f"[INFO] Downloading file: {raw}") >> __gh_tmp__.py
echo.    r = requests.get(raw) >> __gh_tmp__.py
echo.    open(outname, "wb").write(r.content) >> __gh_tmp__.py
echo.    print(f"[DONE] Saved → {outname}") >> __gh_tmp__.py

REM ========== FOLDER MODE ==========
echo else: >> __gh_tmp__.py
echo.    parts = url.split("/tree/") >> __gh_tmp__.py
echo.    repo = parts[0].replace("https://github.com/", "") >> __gh_tmp__.py
echo.    branch = parts[1].split("/")[0] >> __gh_tmp__.py
echo.    subpath = "/".join(parts[1].split("/")[1:]) >> __gh_tmp__.py
echo.    api = f"https://api.github.com/repos/{repo}/contents/{subpath}?ref={branch}" >> __gh_tmp__.py
echo.    print("[INFO] Folder mode: repo =", repo, "branch =", branch) >> __gh_tmp__.py
echo.    print("[INFO] Subpath:", subpath) >> __gh_tmp__.py
echo.    os.makedirs(outname, exist_ok=True) >> __gh_tmp__.py

echo.    def download_recursive(api_url, local_dir): >> __gh_tmp__.py
echo.        os.makedirs(local_dir, exist_ok=True) >> __gh_tmp__.py
echo.        data = requests.get(api_url).json() >> __gh_tmp__.py
echo.        for item in data: >> __gh_tmp__.py
echo.            if item["type"] == "file": >> __gh_tmp__.py
echo.                raw = item["download_url"] >> __gh_tmp__.py
echo.                print("  [FILE]", raw) >> __gh_tmp__.py
echo.                r = requests.get(raw) >> __gh_tmp__.py
echo.                with open(os.path.join(local_dir, item["name"]), "wb") as f: >> __gh_tmp__.py
echo.                    f.write(r.content) >> __gh_tmp__.py
echo.            else: >> __gh_tmp__.py
echo.                print("  [DIR]", item["path"]) >> __gh_tmp__.py
echo.                new_api = f"https://api.github.com/repos/{repo}/contents/{item['path']}?ref={branch}" >> __gh_tmp__.py
echo.                download_recursive(new_api, os.path.join(local_dir, item["name"])) >> __gh_tmp__.py

echo.    download_recursive(api, outname) >> __gh_tmp__.py
echo.    print(f"[DONE] Folder saved → {outname}") >> __gh_tmp__.py

echo print("[COMPLETE]") >> __gh_tmp__.py

REM === Jalankan Python ===
python __gh_tmp__.py

REM === Simpan log link ===
echo %OUTNAME% %URL%>> link_github.txt

REM === Hapus sementara ===
if exist __gh_tmp__.py del /f /q __gh_tmp__.py
if exist gh_tmp_folder rmdir /s /q gh_tmp_folder 2>nul

echo Selesai.
