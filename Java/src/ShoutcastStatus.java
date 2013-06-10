package src;

public class ShoutcastStatus {
	public static void main(String args[]) {

		// You'll most likely want to change the server variable and *maybe* the port.
		String server = "gill.sukhpal.net"; // Server url or IP
		String port = "8000"; // Port Number
		
		String body = HttpRequest.get("http://" + server + ":" + port + "/7.html")
				.header("User-Agent", "Mozilla") // Sets request header
				// You must set the user agent to "Mozilla", or the server will
				// try to stream
				// audio instead of returning the 7.html page.
				.body(); // Gets response body
		body = body.replaceAll("<[^<]+?>", ""); // Removes the html tags
		String[] info = body.split("\\,", 7); // Splits data using delimiter comma
		
		System.out.println("Current Listener: " + info[0]);
		System.out.println("Status: " + info[1]);
		System.out.println("Peak: " + info[2]);
		System.out.println("Max: " + info[3]);
		System.out.println("Reported: " + info[4]);
		System.out.println("Bitrate: " + info[5]);
		System.out.println("Song: " + info[6]);
	}
}
