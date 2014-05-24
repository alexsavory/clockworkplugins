--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local COMMAND = Clockwork.command:New("lrc_on");
COMMAND.tip = "Turn Long Range Chat on for the given amount of minutes.";
COMMAND.text = "<number Minutes>";
COMMAND.access = "o";
COMMAND.arguments = 1;

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
	local minutes = tonumber( arguments[1] );
	
	if (minutes and minutes > 0) then
		Clockwork.kernel:SetSharedVar("lrc", 1);
		Clockwork.kernel:CreateTimer("lrc_time", minutes * 60, 1, function()
			Clockwork.kernel:SetSharedVar("lrc", 0);
			
			Clockwork.player:NotifyAll("Long range chat has been turned off.");
		end);
		
		Clockwork.player:NotifyAll(player:Name().." has turned on long range chat for "..minutes.." minute(s).");
	else
		Clockwork.player:Notify(player, "This is not a valid amount of minutes!");
	end;
end;

COMMAND:Register();