<?php
// *********************************************************************************************************************************
//
// fmPDA.conf.php
//
// *********************************************************************************************************************************
//
// Copyright (c) 2017 - 2024 Mark DeNyse
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.
//
// *********************************************************************************************************************************


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// The FileMaker 'stub' class is provided for backwards compatibility to allow your existing code to call FileMaker::isError().
//
// If your code needs to include the old API code (FileMaker.php) *and* fmPDA, keep this set to 0/false.
//
// If you don't include FileMaker.php & can change your code to replace FileMaker::isError() with fmGetIsError(), keep set this to 0/false.
//
// If you don't include FileMaker.php & don't want to modify your code, set this to 1/true.
//
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
define('DEFINE_FILEMAKER_CLASS', false);





// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//
// Uncomment k_CURL_HTTP_VERSION to specify the HTTP version for fmCURL.
//
// Windows FMS 19+ may not work with curl requesting HTTP 2 so you may need to 'downshift' and uncomment.
//
// Values for k_CURL_HTTP_VERSION can be found here: https://curl.se/libcurl/c/CURLOPT_HTTP_VERSION.html
//
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// define('k_CURL_HTTP_VERSION', CURL_HTTP_VERSION_1_1);


?>
