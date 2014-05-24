--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local COMMAND = Clockwork.command:New("statusset");
COMMAND.tip = "Set your 'status'.";
COMMAND.flags = CMD_DEFAULT;
COMMAND.arguments = 1;
COMMAND.text = "<string text>";

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
	local text = table.concat(arguments, " ");
	
	if (text == "") then
		Clockwork.player:Notify(player, "You did not specify enough text!");
		
		return;
	end;
	player:SetNetworkedString("status", text)
	Clockwork.player:Notify(player, "Your status has been set to: "..text);
end;

COMMAND:Register();