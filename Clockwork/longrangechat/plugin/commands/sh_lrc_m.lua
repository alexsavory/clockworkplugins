--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local Clockwork = Clockwork;

local COMMAND = Clockwork.command:New("lrc_m");
COMMAND.tip = "Send a 'me' to the long range chat.";
COMMAND.text = "<string action>";
COMMAND.arguments = 1;

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
	local listeners = {};
	local text = table.concat(arguments, " ");
	local combatcolor = Color(0, 220, 169, 255);
	if(Clockwork.kernel:GetSharedVar("lrc") == 1) then
		if (player:GetSharedVar("lrc_join") == 1) then
		for k, v in pairs(cwPlayer.GetAll()) do
			if (v:GetSharedVar("lrc_join") == 1) then
				listeners[#listeners + 1] = v;
			end;
		end;
		Clockwork.chatBox:Add(listeners, player, "me", "[LRC-me] "..string.gsub(text, "^.", string.lower));
	else
		Clockwork.player:Notify(player, "You are not part of the Longe range chat!");
	end
	else
		Clockwork.player:Notify(player, "Long range chat isn't enabled.");
	end
	

end;

COMMAND:Register();