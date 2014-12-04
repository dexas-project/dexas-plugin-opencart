bitshares-opencart
======================

# Installation

Copy the contents of the upload folder into your OpenCart directory.

# Configuration


1. Run bitshares_client --server --rpcuser=[your rpc user setting] --rpcpass=[your rpc password setting] --httpport=[your http port setting]
2. type wallet_open <your wallet name, usually default>. This will open you're wallet so you may unlock it.
3. type wallet_unlock 9999999. This will unlock your wallet so new transactions will be posted to your wallet, which this extension will read every x minutes based on a CRON job (CRON URL available via extension settings).
4. In the opencart administration under Extensions->Payments, click the "Install"
   link on the Bitshares row.
5. Also under Extensions->Payments, click the "Edit" link on the Bitshares row.
6. Configure the extension settings including RPC settings that you used above to start the client.
7. Set the status to enabled (this activates the bitshares payment extension and 
    enabled shoppers to select the bitshares payment method).
8. Set up a CRON job to access the CRON job url found in the extension settings. Set it to any desired time interval, based on the size of your server, the better server you have the more frequent the interval can be. It's pretty light-weight you can play with the settings and see how it affects the responsiveness of your site.




# Usage

When a shopping chooses the Bitshares payment method, they will be presented with an
order summary as the next step (prices are shown in whatever currency they've selected
for shopping).  They will be presented with a button called "Pay with Bitshares."  This
button takes the shopper to a Bitshares invoice by opening the Bitshares wallet.  Once payment is received, a link is presented to the 
shopper that will take them back to the order summary.


## OpenCart Support

* [Homepage](http://www.opencart.com/)
* [Documentation](http://docs.opencart.com/)
* [Forums](http://forum.opencart.com/)

# Contribute

To contribute to this project, please fork and submit a pull request.

# License

The MIT License (MIT)

Copyright (c) 2011-2014 Bitshares

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
