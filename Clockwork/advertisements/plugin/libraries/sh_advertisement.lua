local Clockwork = Clockwork;

Clockwork.advertisement = Clockwork.kernel:NewLibrary("Advertisement");
Clockwork.advertisement.stored = {};

-- A function to add an advertisement.
function Clockwork.advertisement:Add(text, delay, color)
	assert(type(text) == "string", "The advertisement argument is not a string.");
	assert(type(color) == "table", "The color argument is not a color.");

	self.stored[#self.stored + 1] = {
		text = "[Advert] "..text,
		delay = delay,
		color = color
	};

end;

-- Some default colors
local red = Color(255, 0, 0, 255);
local green = Color(0, 255, 0, 255);
local blue = Color(0, 0, 255, 255);
local yellow = Color(255,255,0,255);
-- More fancy colors
local skyblue = Color(135,206,250, 255);
local forestgreen = Color(34,139,34,255);
local darkviolet = Color(148,0,211,255);
local orange = Color(255,165,0,255)
-- Add adverts below
Clockwork.advertisement:Add("Check our cool forums! http://aforum.com",5,skyblue)
Clockwork.advertisement:Add("GIVE US MONEY",5,forestgreen)
Clockwork.advertisement:Add("Download our content pack: bit.ly/link",5,darkviolet)
Clockwork.advertisement:Add("Welcome!",5,yellow)